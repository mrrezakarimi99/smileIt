<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\CoreRepository;
use Modules\User\Models\User;

class AuthRepository extends CoreRepository
{
    public function __construct()
    {
        $this->model = new User();
    }
}
