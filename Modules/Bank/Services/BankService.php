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
}
