<?php

namespace Modules\Bank\Http\Resources;

use Modules\Core\Http\Resources\CoreCollection;


class BankCollection extends CoreCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return new BankResource($item , $this->message);
            })
        ];
    }
}
