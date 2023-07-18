<?php

namespace Modules\User\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;
use Modules\User\Models\User;

class UserRepository extends CoreRepository
{

    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new User();
    }

    public function storeWithAssignRole($request)
    {
        return DB::transaction(function () use ($request) {
            $user = $this->store($request->except(['role_id']));
            $user->assignRole([$request->role_id]);

            return $user;
        });
    }

    public function updateWithAssignRole($user , $request)
    {
        return DB::transaction(function () use ($user , $request) {

            if (!is_null($request->password))
                $user->update($request->except(['role_id']));
            else
                $user->update($request->except(['role_id' , 'password']));


            $user->syncRoles([$request->role_id]);
            return $user;
        });
    }


}
