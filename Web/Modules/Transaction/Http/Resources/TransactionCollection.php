<?php

namespace Modules\Transaction\Http\Resources;

use Modules\Core\Http\Resources\CoreCollection;


class TransactionCollection extends CoreCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return new TransactionResource($item , $this->message);
            })
        ];
    }
}
