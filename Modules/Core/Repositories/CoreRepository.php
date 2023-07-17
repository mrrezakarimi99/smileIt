<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Core\Services\CollectionService;


abstract class CoreRepository
{
    protected ?Model $model = null;
    public CollectionService $collectionService;

    public function index(Request $request)
    {
        $query = $this->model->query();

        $this->collectionService->setRequest($request);
        $this->collectionService->setQueryBuilder($query);
        $this->collectionService->setModelClass(get_class($this->model));
        $this->collectionService->initializeSort();
        $this->collectionService->initializeFilter();
        $this->collectionService->initializeWith();

        return $query->paginate($request->get('per_page' , 10));
    }

    public function show($key , $value)
    {
        return $this->model->where($key , $value)->firstOrFail();
    }

    public function store($data)
    {
        return $this->model->create($data)->fresh();
    }

    public function update($key , $value , $data)
    {
        $model = $this->model->where($key , $value)->firstOrFail();
        $model->update($data);
        return $model;
    }

    public function destroy($key , $value)
    {
        $model = $this->model->where($key , $value)->firstOrFail();
        $model->delete();
        return $model;
    }

    public function getResourceFromModel()
    {
        return $this->model::RESOURCE;
    }

    public function getCollectionFromModel()
    {
        return $this->model::RESOURCE_COLLECTION;
    }
}
