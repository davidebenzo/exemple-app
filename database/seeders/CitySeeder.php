<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;


use File;

class CitySeeder extends Seeder
{
  

        /**
    
         * Run the database seeds.
    
         *
    
         * @return void
    
         */
    
         public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/cities.json");
        $cities = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($cities)) {
            throw new \Exception("Il file cities.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($cities as $city) {
            if (is_object($city)) { // Assicurati che sia un oggetto
                City::create([
                    "id" => $city->id,
                    "name" => $city->name,
                    "latitude" => $city->latitude,
                    "longitude" => $city->longitude,
                    "code" => $city->code,
                    "province_id" => $city->province_id,
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
    
    
