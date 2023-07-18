<?php

namespace Modules\Example\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Example\Services\ExampleService;

class ExampleController extends CoreController
{
    public function __construct(ExampleService $service)
    {
        $this->middleware('permission:example-list', ['only' => ['index']]);
        $this->middleware('permission:example-show', ['only' => ['show']]);
        $this->middleware('permission:example-create', ['only' => ['store']]);
        $this->middleware('permission:example-update', ['only' => ['update']]);
        $this->middleware('permission:example-delete', ['only' => ['destroy']]);
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function show($id)
    {
        return $this->service->show('id' , $id);
    }

    public function store(Request $request)
    {
        return $this->service->store($request->validated());
    }

    public function update($id , Request $request)
    {
        return $this->service->update('id' , $id , $request->validated());
    }

    public function destroy($id)
    {
        return $this->service->destroy('id' , $id);
    }
}
