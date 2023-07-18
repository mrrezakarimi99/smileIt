<?php

namespace Modules\Example\Http\Resources;

use Modules\Core\Http\Resources\CoreCollection;


class ExampleCollection extends CoreCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return new ExampleResource($item , $this->message);
            })
        ];
    }
}
