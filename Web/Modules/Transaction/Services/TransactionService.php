<?php

namespace Modules\Transaction\Services;

use Modules\Core\Services\CoreService;
use Modules\Transaction\Repositories\TransactionRepository;

class TransactionService extends CoreService
{
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'Transaction';
    }
}
