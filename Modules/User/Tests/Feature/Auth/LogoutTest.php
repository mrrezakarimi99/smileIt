<?php

namespace Modules\User\Tests\Feature\Auth;

use Modules\Core\Tests\CoreTestCase;

class LogoutTest extends CoreTestCase
{
    public function test_token_required_validation_works_in_logout_api()
    {
        $response = $this->postJson('api/v1/auth/logout');
        $response->assertStatus(401);
    }

    public function test_logout_api_works()
    {
        $response = $this->postJson('api/v1/auth/logout' , [] , $this->getAuthHeader());
    }
}
