<?php

namespace Modules\User\Http\Resources\User;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $id
 * @property mixed $username
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $created_at
 */
class UserResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'id'         => $this->id ,
            'username'   => $this->username ,
            'first_name' => $this->first_name ,
            'last_name'  => $this->last_name ,
            'created_at' => $this->created_at ,
        ];
    }
}
