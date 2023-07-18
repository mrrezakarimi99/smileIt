<?php

namespace Modules\Account\Http\Resources;

use Modules\Core\Http\Resources\CoreCollection;


class AccountCollection extends CoreCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return new AccountResource($item , $this->message);
            })
        ];
    }
}
