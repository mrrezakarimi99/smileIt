<?php

namespace Modules\Transaction\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Http\Requests\CoreFormRequest;
use Modules\Transaction\Models\Transaction;

class TransactionFormRequest extends CoreFormRequest
{

    public function __construct(array $query = [] , array $request = [] , array $attributes = [] , array $cookies = [] , array $files = [] , array $server = [] , $content = null , Model $model = null)
    {
        parent::__construct($query , $request , $attributes , $cookies , $files , $server , $content);
        $this->model = new Transaction();
    }

}
