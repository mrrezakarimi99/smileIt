<?php

namespace Modules\Core\Services;

use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Traits\CoreApiResponser;

abstract class CoreService
{
    use CoreApiResponser;

    protected ?CoreRepository $repository = null;
    public string $modelName = '';

    public function index($request)
    {
        $collection = $this->repository->getCollectionFromModel();
        return new $collection($this->repository->index($request) , $this->generateMessage('index'));
    }

    public function show($key , $slug)
    {
        $resource = $this->repository->getResourceFromModel();
        return new $resource($this->repository->show($key , $slug) , $this->generateMessage('show'));
    }

    public function store($data)
    {
        $resource = $this->repository->getResourceFromModel();
        return new $resource($this->repository->store($data) , $this->generateMessage('store'));
    }

    public function update($key , $slug , $data)
    {
        $resource = $this->repository->getResourceFromModel();
        return new $resource($this->repository->update($key , $slug , $data) , $this->generateMessage('update'));
    }

    public function destroy($key , $value)
    {
        $resource = $this->repository->getResourceFromModel();
        return new $resource($this->repository->destroy($key , $value) , $this->generateMessage('destroy'));
    }

    public function generateMessage($method , string $key = 'success')
    {
        return trans(strtolower($this->modelName) . '::response.' . $method . '.' . $key , [
            'module' => $this->modelName
        ]);
    }
}
