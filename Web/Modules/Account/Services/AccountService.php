<?php

namespace Modules\Account\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Account\Http\Requests\ChargeRequest;
use Modules\Account\Http\Requests\TransferRequest;
use Modules\Account\Repositories\AccountRepository;
use Modules\Core\Services\CoreService;
use Modules\Transaction\Models\Transaction;
use Modules\Transaction\Repositories\TransactionRepository;

class AccountService extends CoreService
{
    protected TransactionRepository $transactionRepository;

    public function __construct(
        AccountRepository     $repository ,
        TransactionRepository $transactionRepository
    )
    {
        $this->repository = $repository;
        $this->modelName = 'Account';
        $this->transactionRepository = $transactionRepository;
    }

    public function storeWithExtraData(array $data)
    {
        $data = $this->prepareData($data);
        return $this->store($data);
    }

    private function prepareData(array $data): array
    {
        $data['account_number'] = $this->generateAccountNumber();
        if (!array_key_exists('user_id' , $data)) {
            $data['user_id'] = auth()->id();
        }
        return $data;
    }

    private function generateAccountNumber(): string
    {
        return 60379974 . rand(10000000 , 99999999);
    }

    public function updateWithExtraData(array $data , int $id)
    {
        $data = $this->prepareData($data);
        return $this->update('id' , $id , $data);
    }

    public function charge(ChargeRequest $request)
    {
        $resource = $this->repository->getResourceFromModel();
        try {
            DB::beginTransaction();

            // Fetch the account
            $account = $this->repository->show('account_number' , $request->account_number);

            //make transaction
            $this->transactionRepository->store([
                'to_account_id' => $account->id ,
                'user_id'       => auth()->id() ,
                'amount'        => $request->amount ,
                'description'   => $request->description ,
                'type'          => Transaction::TYPE_DEPOSIT ,
            ]);

            //update balance for account
            $this->repository->updateBalance($account->id);

            DB::commit();

            // Fetch the updated account after the transaction and balance update
            $account = $this->repository->show('account_number' , $request->account_number);

            return new $resource($account , $this->generateMessage('payment' , 'charge.success'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('payment charge error');
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return $this->errorResponse([] , $this->generateMessage('payment' , 'charge.fail') , 500);
        }
    }

    public function withdraw(ChargeRequest $request)
    {
        $resource = $this->repository->getResourceFromModel();
        try {
            DB::beginTransaction();

            // Fetch the account
            $account = $this->repository->show('account_number' , $request->account_number);

            //check balance is enough
            if ($this->checkBalanceIsEnough($account->balance , $request->amount)) {
                return $this->errorResponse([] , $this->generateMessage('payment' , 'not_enough_balance') , 422);
            }

            //make transaction
            $this->transactionRepository->store([
                'from_account_id' => $account->id ,
                'user_id'         => auth()->id() ,
                'amount'          => $request->amount ,
                'description'     => $request->description ,
                'type'            => Transaction::TYPE_WITHDRAW ,
            ]);

            //update balance for account
            $this->repository->updateBalance($account->id);

            DB::commit();

            // Fetch the updated account after the transaction and balance update
            $account = $this->repository->show('account_number' , $request->account_number);

            return new $resource($account , $this->generateMessage('payment' , 'withdraw.success'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('payment withdraw error');
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return $this->errorResponse([] , $this->generateMessage('payment' , 'withdraw.fail') , 500);
        }
    }

    /**
     * @param TransferRequest $request
     * @return JsonResponse
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Fetch the account
            $fromAccount = $this->repository->show('account_number' , $request->from_account_number);
            $toAccount = $this->repository->show('account_number' , $request->to_account_number);

            //check balance is enough
            if ($this->checkBalanceIsEnough($fromAccount->balance , $request->amount)) {
                return $this->errorResponse([] , $this->generateMessage('payment' , 'not_enough_balance') , 422);
            }

            //make transaction
            $this->transactionRepository->store([
                'from_account_id' => $fromAccount->id ,
                'to_account_id'   => $toAccount->id ,
                'user_id'         => auth()->id() ,
                'amount'          => $request->amount ,
                'description'     => $request->description ,
                'type'            => Transaction::TYPE_TRANSFER ,
            ]);

            //update balance for account
            $this->repository->updateBalance($fromAccount->id);
            $this->repository->updateBalance($toAccount->id);

            DB::commit();
            return $this->successResponse([] , $this->generateMessage('payment' , 'transfer.success'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('payment transfer error');
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return $this->errorResponse([] , $this->generateMessage('payment' , 'transfer.fail') , 500);
        }
    }

    /**
     * @param $balance
     * @param int $amount
     * @return bool
     */
    private function checkBalanceIsEnough($balance , int $amount): bool
    {
        $balance = str_replace(',' , '' , $balance);
        $balance = intval($balance);
        return $balance < $amount;
    }
}
