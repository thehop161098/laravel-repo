<?php

namespace Tests\Unit\Models;

use App\User;
use Tests\TestCase;
use App\Services\UserServices;
use Illuminate\Support\Facades\Artisan;

class UserTest extends TestCase
{
    
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'UserSeeder']);
        $this->userService = new UserServices();
    }
    /**
     * Get user by id
     */
    public function getUserByIdDataProvider()
    {
        return [
            'user_id_1' => [
                'value' => [
                    'id' => 1,
                ],
                'success' => true
            ],
            'user_id_2' => [
                'value' => [
                    'id' => 2,
                ],
                'success' => true
            ],
            'user_id_3' => [
                'value' => [
                    'id' => 3,
                ],
                'success' => false
            ],
        ];
    }
    /**
     * Get all user
     */
    public function getUserAllDataProvider()
    {
        return [
            'user_count_1' => [
                'value' => 1,
                'success' => false,
            ],
            'user_count_2' => [
                'value' => 2,
                'success' => true,
            ],
            'user_count_3' => [
                'value' => 3,
                'success' => false,
            ],
        ];
    }
    /**
     * Get user for create data
     */
    public function getUserForCreateDataProvider()
    {
        return [
            'user_for_create' => [
                'value' => [
                    'name' => 'Tran The Hop 3',
                    'url' => 'https://laravel.com/docs/7.x',
                    'select_box' => '1',
                    'image' => 'image1.jpg',
                    'start_date' => '2021-04-07',
                    'end_date' => '2021-04-08',
                    'email' => 'tranthehop3@gmail.com',
                    'password' => '123123',
                    'email_verified_at' => null,
                    'created_at' => '2021-04-08 10:03:54',
                    'updated_at' => '2021-04-08 10:03:54',
                ],
                'success' => true
            ],
        ];
    }
    /**
     * Get user for update data
     */
    public function getUserForUpdateDataProvider()
    {
        return [
            'user_update_name_4' => [
                'value' => [
                    'name' => 'Tran The Hop 4',
                    'id' => 2,
                    'password' => '',
                    'password_confirmation' => '',
                ],
                'success' => true
            ],
            
        ];
    }
    /**
     * Get user for delete data
     */
    public function getUserForDeleteDataProvider()
    {
        return [
            'user_delete_2' => [
                'value' => [
                    'id' => 1,
                ],
                'success' => true,
            ],
        ];
    }
    /**
     * Test get user by id
     * 
     * @dataProvider getUserByIdDataProvider
     *
     * @param $value 
     * @param $success 
     * 
     * @return void
     */
    public function testGetUserById($value, $success)
    {
        $id = $value['id'];
        $user = $this->userService->getOne($id);
        $result = $user !== NULL ? true : false;
        $this->assertEquals($success, $result);
    }
    /**
     * Test get all user
     * 
     * @dataProvider getUserAllDataProvider
     *
     * @param $value 
     * @param $success 
     * 
     * @return void
     */
    public function testGetAllUser($value, $success)
    {
        $userCount = $this->userService->getAll()->count();
        $this->assertEquals($success, $userCount === $value);
    }
    /**
     * Test get user for create
     * 
     * @dataProvider getUserForCreateDataProvider
     *
     * @param $value 
     * 
     * @return void
     */
    public function testGetUserForCreate($value)
    {
        $result = $this->userService->create($value);
        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($value['name'], $result->name);
        $this->assertEquals($value['email'], $result->email);
    }
    /**
     * Test get user for update
     * 
     * @dataProvider getUserForUpdateDataProvider
     *
     * @param $value
     * 
     * @return void
     */
    public function testGetUserForUpdate($value)
    {
        $request = new \Illuminate\Http\Request($value);
        $request->replace($value);
        $id = $value['id'] ?? '';
        // update user
        $user = $this->userService->update($request, $id);
        $this->assertTrue($user);
        // find user
        $result = User::find($id, ['name']);
        $key = array_key_first($value);
        $this->assertEquals($value[$key], $result->name);
    }
    /**
     * Test get user for delete
     * 
     * @dataProvider getUserForDeleteDataProvider
     *
     * @param $value
     * 
     * @return void
     */
    public function testGetUserForDelete($value)
    {
        $id = $value['id'];
        $result = $this->userService->delete($id);
        $this->assertTrue($result);
    }
}
