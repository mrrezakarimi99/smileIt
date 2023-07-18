<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Transaction\Services\TransactionService;

class TransactionController extends CoreController
{
    public function __construct(TransactionService $service)
    {
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
