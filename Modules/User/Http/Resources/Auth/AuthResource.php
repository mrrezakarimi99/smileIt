<?php

namespace Modules\User\Http\Resources\Auth;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $id
 * @property mixed $username
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $access_token
 * @property mixed $expires_in
 */
class AuthResource extends CoreResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id ,
            'username'     => $this->username ,
            'first_name'   => $this->first_name ,
            'last_name'    => $this->last_name ,
            'access_token' => $this->access_token ,
            'expires_in'   => $this->expires_in ,
        ];
    }
}
