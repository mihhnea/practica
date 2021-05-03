<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->insert([
            [
                'name' => 'Mihnea',
                'user' => 'mihnea',
                'members' => 3,
                'actions' => 'edit/delete'
            ],
            [
                'name' => 'Andrei',
                'user' => 'andrei',
                'members' => 4,
                'actions' => 'edit/delete'
            ],
            [
                'name' => 'Lala',
                'user' => 'lala',
                'members' => 6,
                'actions' => 'edit/delete'
            ],
            [
                'name' => 'Gimmi',
                'user' => 'gimmi',
                'members' => 7,
                'actions' => 'edit/delete'
            ],
        ]);
    }
}
