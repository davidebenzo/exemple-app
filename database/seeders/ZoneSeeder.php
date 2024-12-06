<?php

namespace Database\Seeders;

use App\Models\Zip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;


use File;
class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/zones.json");
        $zones = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($zones)) {
            throw new \Exception("Il file zones.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($zones as $zone) {
            if (is_object($zone)) { // Assicurati che sia un oggetto
                Zone::create([
                    "name" => $zone->name,
                    
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
