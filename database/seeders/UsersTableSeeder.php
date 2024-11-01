<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            [
                'name' =>  'kepala lab',
                'email' => 'kepalalab@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'kepala_lab',
            ],

            //agent
            [
                'name' =>  'laboran',
                'email' => 'laboran@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'laboran',
            ],

            //user
            [
                'name' =>  'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'asisten_dosen',
            ]
        ]);
    }
}
