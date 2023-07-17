<?php

namespace Modules\Account\Repositories;

use Modules\Account\Models\Account;
use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;

class AccountRepository extends CoreRepository
{
    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new Account();
    }
}
