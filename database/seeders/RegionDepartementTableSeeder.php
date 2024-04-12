<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionDepartementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionDepartement= [
            [
              "region"=> "Région du Folon",
              "departement"=> ["Kaniasso", "Minignan"]
            ],
            [
              "region"=> "Région du Bagoué",
              "departement"=> ["Boundiali", "Kouto", "Tengréla"]
            ],
            [
              "region"=> "Région du Poro",
              "departement"=> ["Dikodougou", "Korhogo", "M’Bengué", "Sinématiali"]
            ],
            [
              "region"=> "Région du Tchologo",
              "departement"=> ["Ferkessédougou", "Kong", "Ouangolodougou"]
            ],
            [
              "region"=> "Région du Worodougou",
              "departement"=> ["Kani", "Séguéla"]
            ],
            [
              "region"=> "Région du Hambol",
              "departement"=> ["Dabakala", "Katiola", "Niakaramadougou"]
            ],
            [
              "region"=> "Région du Gbêkê",
              "departement"=> ["Béoumi", "Botro", "Bouaké", "Sakassou"]
            ],
            [
              "region"=> "Région de Bounkani",
              "departement"=> ["Bouna", "Doropo", "Nassian", "Téhini"]
            ],
            [
              "region"=> "Région du Gontougou",
              "departement"=> ["Bondoukou", "Koun-Fao", "Sandégué", "Tanda", "Transua"]
            ]
          ];
         //dd($regionDepartement);
        //$regions = json_decode($regionDepartement, true);
        $regions = $regionDepartement;

        foreach ($regions as $regionData) {
            
            $region = new Region([ 
                'name' => $regionData['region']
            ]);
            $region->save();
            
            foreach ($regionData['departement'] as $departementName) {
                $departement = new Departement([
                    'name' => $departementName,
                    'region_id' => $region->id
                ]);
                $departement->save();
            }
        }
    }
}
