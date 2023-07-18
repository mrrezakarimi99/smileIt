<?php

namespace Modules\Bank\Services;

use Modules\Bank\Repositories\BankRepository;
use Modules\Core\Services\CoreService;

class BankService extends CoreService
{
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'Bank';
    }

    public function destroyWithCheckAccounts($id)
    {
        $model = $this->repository->show('id' , $id);
        if ($model->accounts()->count() > 0) {
            return $this->errorResponse([] , $this->generateMessage('destroy' , 'not_allowed') , 403);
        }
        return $this->destroy('id' , $id);
    }
}
