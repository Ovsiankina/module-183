<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kids = [
            ["name" => "Angélique", "birthDate" => "2020-02-05", "address" => "Avenue du temple 2", "zipCode" => 1015, "city" => "Saint-Sulpice", "wishList" => "Un livre sur les poneys.", "wiseLevel" => "Très sage"],
            ["name" => "Kévin", "birthDate" => "2021-06-15", "address" => "Route des tanneurs", "zipCode" => 1530, "city" => "Payerne", "wishList" => "Un robot tueur, une batterie, la playstation 5 avec Mortal Kombat, un pistolet à pétards, que mon petit frère se casse un bras avant de se faire adopter dans un monastère par des soeurs ayant fait voeux de pauvreté.", "wiseLevel" => "Un vrai petit mer****"],
            ["name" => "Raphaël", "birthDate" => "2020-02-20", "address" => "Rue du Grand-Lézard 11", "zipCode" => 2054, "city" => "Chézard-St-Martin", "wishList" => "Habiter plus proche de Lausanne et de la civilisation", "wiseLevel" => "Sage la plupart du temps"],
            ["name" => "Quentin", "birthDate" => "2020-03-28", "address" => "Route de la Planche 220", "zipCode" => 1897, "city" => "Bouveret", "wishList" => "Un puzzle de la Pat'Patrouille et un poster de VEN1", "wiseLevel" => "Sage la plupart du temps"],
        ];

        foreach ($kids as $kid) {
            $kid["created_at"] = now();
            $kid["updated_at"] = $kid["created_at"];
            DB::table('kids')->insert($kid);
        }
    }
}
