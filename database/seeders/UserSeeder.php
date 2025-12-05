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
        $users = [
            ["name" => "Père noël", "email" => "pere@noel.com", "password" => Hash::make("salut")]
        ];

        foreach ($users as $user) {
            $user["created_at"] = now();
            $user["updated_at"] = $user["created_at"];
            DB::table('users')->insert($user);
        }
    }
}
