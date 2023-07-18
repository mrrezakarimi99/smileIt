<?php

namespace Modules\Transaction\Http\Resources;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $id
 * @property mixed $user
 * @property mixed $amount
 * @property mixed $description
 * @property mixed $type
 * @property mixed $fromAccount
 * @property mixed $toAccount
 * @property mixed $created_at
 */
class TransactionResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'id'          => $this->id ,
            'user'        => $this->user ? [
                'id'       => $this->user->id ,
                'fullName' => $this->user->fullname ,
            ] : null ,
            'amount'      => $this->amount ,
            'description' => $this->description ,
            'type'        => $this->type ,
            'from'        => $this->fromAccount ? $this->fromAccount->account_number : null ,
            'to'          => $this->toAccount ? $this->toAccount->account_number : null ,
            'created_at'  => $this->created_at ,
        ];
    }
}
