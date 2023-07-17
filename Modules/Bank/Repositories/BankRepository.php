<?php

namespace Modules\Bank\Repositories;

use Modules\Bank\Models\Bank;
use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;

class BankRepository extends CoreRepository
{
    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new Bank();
    }
}
