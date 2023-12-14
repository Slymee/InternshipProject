<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminDataDetails extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'slymee',
            'email' => 'slimismurf@gmail.com',
            'password' => Hash::make('slymee'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
