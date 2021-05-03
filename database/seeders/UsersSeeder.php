<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Mihnea',
                'email' => 'mihnea@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Roweb',
                'email' => 'rwb@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Andrei',
                'email' => 'andrei@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'lalala',
                'email' => 'lalala@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Gimmi',
                'email' => 'gimmi@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Sarmale',
                'email' => 'sarmale@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Sabina',
                'email' => 'Sabina@email.ro',
                'password' => Hash::make('parola')
            ],
            [
                'name' => 'Ciorbea',
                'email' => 'ciorbea@email.ro',
                'password' => Hash::make('parola')
            ],
        ]);
    }
}
