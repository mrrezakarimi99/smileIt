<?php

namespace Modules\User\Tests\Feature\Auth;

use Modules\Core\Tests\CoreTestCase;
use Modules\User\Models\User;


class UserTest extends CoreTestCase
{
    public function test_get_profile()
    {
        $response = $this->getJson('api/v1/user/profile' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'username' ,
                'first_name' ,
                'last_name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);
    }

    public function test_get_all_user()
    {
        $response = $this->getJson('api/v1/user' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'username' ,
                    'first_name' ,
                    'last_name' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);

    }

    public function test_get_user_by_id()
    {
        $response = $this->getJson('api/v1/user/1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,
                'username' ,
                'first_name' ,
                'last_name' ,
                'created_at' ,
            ] ,
            'message' ,
            'status'
        ]);

    }

    public function test_get_all_user_with_per_page_and_page()
    {
        $response = $this->getJson('api/v1/user?per_page=2&page=1' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'username' ,
                    'first_name' ,
                    'last_name' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        $this->assertEquals(2 , count($response->json()['data']));
        $this->assertEquals(1 , $response->json()['meta']['current_page']);

    }

    public function test_get_all_user_with_search()
    {
        $response = $this->getJson('api/v1/user?filter[search]=admin' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'username' ,
                    'first_name' ,
                    'last_name' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        $this->assertEquals(1 , count($response->json()['data']));
        $this->assertEquals(1 , $response->json()['meta']['total']);
        $this->assertEquals('admin' , $response->json()['data'][0]['username']);
    }

    public function test_get_all_user_with_sort_by()
    {
        User::factory()->create([
            'username'   => 'user' ,
            'created_at' => now()->addMinutes(1) ,
        ]);
        $response = $this->getJson('api/v1/user?sort_by=-created_at' , $this->getAuthHeader());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id' ,
                    'username' ,
                    'first_name' ,
                    'last_name' ,
                    'created_at' ,
                ]
            ] ,
            'links' ,
            'meta' ,
            'message' ,
            'status'
        ]);
        $this->assertEquals('user' , $response->json()['data'][0]['username']);
    }

    //TODO need to add test for relationship such as balance and transaction
}
