<?php

namespace Modules\User\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Services\CoreService;
use Modules\User\Http\Resources\User\UserResource;
use Modules\User\Repositories\UserRepository;

class UserService extends CoreService
{
    private ?Authenticatable $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
        $this->modelName = 'User';
        $this->user = Auth::user();
    }

    public function profile(): UserResource
    {
        return new UserResource($this->user , $this->generateMessage("profile"));
    }

    public function storeWithAssignRole($request)
    {
        $result = $this->repository->storeWithAssignRole($request);
        if (!$result) {
            return $this->errorResponse([] , "Can not create User!");
        }
        return new UserResource($result , "User created Successfully");
    }

    public function updateWithAssignRole($user , $request)
    {
        $result = $this->repository->updateWithAssignRole($user , $request);
        if (!$result) {
            return $this->errorResponse([] , "Can not update User!");
        }
        return new UserResource($result , "User updated Successfully");
    }


}
