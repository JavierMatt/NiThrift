<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            "firstName"=> "irham",
            "lastName" => "atmoko",
            "phone" => "085156630580",
            "email"=> "hamza@gmail.com",
            "password"=> Hash::make("qwerty123"),
            "province" => "jakarta",
            "city" => "Jakarta Utara",
            "postcalCode" => 11480
        ]);
    }
}
