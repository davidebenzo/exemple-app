<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zip;
use File;

class ZipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/zips.json");
        $zips = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($zips)) {
            throw new \Exception("Il file zips.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($zips as $zip) {
            if (is_object($zip)) { // Assicurati che sia un oggetto
                Zip::create([
                    "code" => $zip->code,
                    "city_id" => $zip->city_id,
                    
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
