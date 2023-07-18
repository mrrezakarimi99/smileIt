<?php

namespace Modules\Example\Repositories;

use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;
use Modules\Example\Models\Example;

class ExampleRepository extends CoreRepository
{
    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new Example();
    }
}
