<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;

class StoreUserRequestTest extends TestCase
{
    /**
     * @dataProvider userDataProvider
     * A basic test example.
     *
     * @return void
     */
    public function testUser($value, $error)
    {
        $successData = $this->getSuccessData();
        $data = array_merge($successData, $value);
        $key = array_key_first($value);

        $request = new StoreUserRequest();
        $rules = $request->rules();
        $validator = Validator::make($data, $rules);
        $result = $validator->errors()->has($key);
        // dd($result);
        $this->assertEquals($error, $result);
    }

    public function userDataProvider()
    {
        return [
            'url_required' => [
                'value' => [
                    'url' => '',
                ],
                'error' => true
            ],
            // 'email_required' => [
            //     'value' => [
            //         'email' => '',
            //     ],
            //     'error' => true
            // ],
            // 'email_validate_email' => [
            //     'value' => [
            //         'email' => 'tranthehop.com',
            //     ],
            //     'error' => true
            // ],
            // 'email_unique' => [
            //     'value' => [
            //         'email' => 'tranthehop@gmail.com',
            //     ],
            //     'error' => true
            // ],
            // 'email_success' => [
            //     'value' => [
            //         'email' => 'tranthehop2@gmail.com',
            //     ],
            //     'error' => false
            // ],
            // 'password' => [
            //     'value' => [
            //         'password' => '123123',
            //     ],
            //     'error' => false
            // ],
            // 'password_confirmation' => [
            //     'value' => [
            //         'password_confirmation' => '321321',
            //     ],
            //     'error' => true
            // ],
            // 'start_date' => [
            //     'value' => [
            //         'start_date' => '07/04/2021',
            //     ],
            //     'error' => false
            // ],
            // 'end_date' => [
            //     'value' => [
            //         'end_date' => '06/04/2021',
            //     ],
            //     'error' => true
            // ],
            // 'image' => [
            //     'value' => [
            //         'image' => UploadedFile::fake()->create('img.pdf', 5120),
            //     ],
            //     'error' => true
            // ],
            // 'checked' => [
            //     'value' => [
            //         'checked' => 'on',
            //     ],
            //     'error' => false
            // ],
            
        ];
    }

    public function getSuccessData()
    {
        return [
            'url' => 'https://laravel.com/docs/7.x/validation',
            'name' => 'Tran The Hop',
            'email' => 'tranthehop@gmail.com',
            'password' => '123123',
            'password_confirmation' => '123123',
            'start_date' => '06/04/2021',
            'end_date' => '07/04/2021',
            'image' => UploadedFile::fake()->create('avatar.png'),
            'select_box' => '2',
            'checked' => 'on',
        ];
    }
}
