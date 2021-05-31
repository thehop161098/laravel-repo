<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Tran The Hop',
                    'url' => 'https://laravel.com/docs/7.x',
                    'select_box' => '1',
                    'image' => 'image1.jpg',
                    'start_date' => '2021/04/07',
                    'end_date' => '2021/04/08',
                    'email' => 'tranthehop@gmail.com',
                    'password' => bcrypt('123123'),
                    'created_at' => '2021-04-08 10:03:54',
                    'updated_at' => '2021-04-08 10:03:54',
                ],
                [
                    'id' => 2,
                    'name' => 'Tran The Hop 2',
                    'url' => 'https://laravel.com/docs/7.x',
                    'select_box' => '2',
                    'image' => 'image2.jpg',
                    'start_date' => '2021/04/07',
                    'end_date' => '2021/04/10',
                    'email' => 'tranthehop2@gmail.com',
                    'password' => bcrypt('123123'),
                    'created_at' => '2021-04-08 10:03:54',
                    'updated_at' => '2021-04-08 10:03:54',
                ],
            ]
        );
    }
}
