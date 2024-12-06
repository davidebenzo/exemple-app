<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;


use File;
class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/regions.json");
        $regions = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($regions)) {
            throw new \Exception("Il file regions.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($regions as $region) {
            if (is_object($region)) { // Assicurati che sia un oggetto
                Region::create([
                    "name" => $region->name,
                    "zone_id" => $region->zone_id,
                    
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
