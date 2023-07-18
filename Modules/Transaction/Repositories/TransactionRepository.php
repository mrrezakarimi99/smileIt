<?php

namespace Modules\Transaction\Repositories;

use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;
use Modules\Transaction\Models\Transaction;

class TransactionRepository extends CoreRepository
{
    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new Transaction();
    }
}
