<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BoardPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('board_page')->insert([
            [
                'name' => 'Mihnea',
                'description' => 'fdsafdsafdsa',
                'assignment' => '',
                'status' => 'created',
                'dateofcreation' => '2020/03/23'
            ],
            [
                'name' => 'Alex',
                'description' => 'fdsafdsafdsa',
                'assignment' => '',
                'status' => 'created',
                'dateofcreation' => '2020/12/25'
            ],
            [
                'name' => 'Lalla',
                'description' => 'gfdagfds',
                'assignment' => '',
                'status' => 'created',
                'dateofcreation' => '2019/10/11'
            ],
            [
                'name' => 'Gimmi',
                'description' => 'gfdsgfds',
                'assignment' => '',
                'status' => 'created',
                'dateofcreation' => '2021/04/13'
            ],

        ]);
    }
}
