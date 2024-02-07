<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Slymee',
            'username' => 'slymee',
            'email' => 'slimismurf@gmail.com',
            'password' => Hash::make('slymee'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'MeeMee',
            'username' => 'meemee',
            'email' => 'meemee@gmail.com',
            'password' => Hash::make('meemee'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
        ]);

        DB::table('users')->insert([
            'name' => 'Onikuma',
            'username' => 'onikuma',
            'email' => 'onikuma@gmail.com',
            'password' => Hash::make('meemee'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            
        ]);
    }
}
