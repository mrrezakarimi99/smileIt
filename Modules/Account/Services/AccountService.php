<?php

namespace Modules\Account\Services;

use Modules\Account\Repositories\AccountRepository;
use Modules\Core\Services\CoreService;

class AccountService extends CoreService
{
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'Account';
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
}
