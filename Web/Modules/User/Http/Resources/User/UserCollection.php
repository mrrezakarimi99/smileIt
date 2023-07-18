<?php

namespace Modules\User\Http\Resources\User;

use Modules\Core\Http\Resources\CoreCollection;


class UserCollection extends CoreCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return new UserResource($item , $this->message);
            })
        ];
    }
}
