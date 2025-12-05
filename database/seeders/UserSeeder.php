<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                "name" => "Père noël",
                "email" => "pere@noel.com",
                "password" => Hash::make("salut")
            ],
            [
                "name" => "Père Fouettard",
                "email" => "fouettard@noel.com",
                "password" => Hash::make("salut")
            ]
        ];

        foreach ($users as $data) {
            $data["created_at"] = now();
            $data["updated_at"] = $data["created_at"];

            DB::table('users')->insert($data);
        }

        // Retrieve Fouettard
        $fouettard = User::where("email", "fouettard@noel.com")->first();

        if ($fouettard) {
            // Create a token with ONLY kids:read:unwise ability
            $token = $fouettard->createToken(
                'pere-fouettard-unwise',
                ['kids:read:unwise']
            );
        }
    }
}
