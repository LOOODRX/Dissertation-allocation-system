<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users') -> insert([
            //modul owner
            [
                'id' => '220100001',
                'name' => 'modul_owner',
                'email' => 'modul_owner@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'modul_owner',
    
            ],
                //supervisor
            [
                'id' => '220200001',
                'name' => 'supervisor',
                'email' => 'supervisor@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'supervisor',
    
            ],
                //student
            [
                'id' => '220316534',
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'student',
                ],
                //secound assessor
            [
                'id' => '220400001',
                'name' => 'secound_assessor',
                'email' => 'secound_assessor@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'secound_assessor',
            ],
        ]);
    }
}
