<?php

namespace Modules\Account\Http\Resources;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $id
 * @property mixed $account_number
 * @property mixed $balance
 * @property mixed $created_at
 */
class AccountResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'id'             => $this->id ,
            'bank'           => $this->bank ? [
                'id'   => $this->bank->id ,
                'name' => $this->bank->name ,
            ] : null ,
            'user'           => $this->user ? [
                'id'       => $this->user->id ,
                'fullName' => $this->user->fullName ,
            ] : null ,
            'account_number' => $this->account_number ,
            'balance'        => $this->balance ,
            'created_at'     => $this->created_at ,
        ];
    }
}
