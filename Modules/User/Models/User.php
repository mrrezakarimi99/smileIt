<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\Core\Models\CoreAuthenticatable;
use Modules\User\Http\Resources\User\UserCollection;
use Modules\User\Http\Resources\User\UserResource;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property mixed $remember_token
 * @property mixed $password
 */
class User extends CoreAuthenticatable implements JWTSubject
{
    use HasFactory , Notifiable , softDeletes;

    const RESOURCE = UserResource::class;
    const RESOURCE_COLLECTION = UserCollection::class;

    protected $guarded = [
        'id' ,
        'created_at' ,
        'updated_at' ,
        'deleted_at' ,
    ];

    protected $hidden = [
        'password' ,
        'remember_token' ,
    ];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getSearchFields(): array
    {
        return [
            'username' ,
        ];
    }

    public function getFilterFields(): array
    {
        return [
            'created_at' ,
        ];
    }

    public function getWithFields(): array
    {
        return [];
    }
}
