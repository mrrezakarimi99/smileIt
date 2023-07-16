<?php

namespace Modules\Example\Services;

use Modules\Core\Services\CoreService;
use Modules\Example\Repositories\ExampleRepository;

class ExampleService extends CoreService
{
    public function __construct(ExampleRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'Example';
    }
}
