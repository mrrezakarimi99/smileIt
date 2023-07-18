<?php

namespace Modules\Account\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Models\Account;
use Modules\Core\Http\Requests\CoreFormRequest;

/**
 * @property mixed $from_account_number
 * @property mixed $to_account_number
 * @property mixed $amount
 * @property mixed $description
 */
class TransferRequest extends CoreFormRequest
{

    public function __construct(array $query = [] , array $request = [] , array $attributes = [] , array $cookies = [] , array $files = [] , array $server = [] , $content = null , Model $model = null)
    {
        parent::__construct($query , $request , $attributes , $cookies , $files , $server , $content);
        $this->model = new Account();
    }

    public function rules()
    {
        return [
            'amount'              => 'required|numeric|min:1' ,
            'from_account_number' => 'required|exists:accounts,account_number' ,
            'to_account_number'   => 'required|exists:accounts,account_number' ,
            'description'         => 'nullable|string|max:255' ,
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'from_account_number' => str_replace('-' , '' , $this->from_account_number) ,
            'to_account_number'   => str_replace('-' , '' , $this->to_account_number) ,
        ]);
    }

}
