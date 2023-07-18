<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Models\Account;
use Modules\Core\Http\Requests\CoreFormRequest;

/**
 * @property mixed $account_number
 * @property mixed $amount
 * @property mixed $description
 */
class ChargeRequest extends CoreFormRequest
{

    public function __construct(array $query = [] , array $request = [] , array $attributes = [] , array $cookies = [] , array $files = [] , array $server = [] , $content = null , Model $model = null)
    {
        parent::__construct($query , $request , $attributes , $cookies , $files , $server , $content);
        $this->model = new Account();
    }

    public function rules()
    {
        return [
            'amount'         => 'required|numeric|min:1' ,
            'account_number' => 'required|exists:accounts,account_number' ,
            'description'    => 'nullable|string|max:255' ,
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'account_number' => str_replace('-' , '' , $this->account_number) ,
        ]);
    }

}
