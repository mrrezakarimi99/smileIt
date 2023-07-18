<?php

namespace Modules\Example\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Http\Requests\CoreFormRequest;
use Modules\Example\Models\Example;

class ExampleFormRequest extends CoreFormRequest
{

    public function __construct(array $query = [] , array $request = [] , array $attributes = [] , array $cookies = [] , array $files = [] , array $server = [] , $content = null , Model $model = null)
    {
        parent::__construct($query , $request , $attributes , $cookies , $files , $server , $content);
        $this->model = new Example();
    }

}
