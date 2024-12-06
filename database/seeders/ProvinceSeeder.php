<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use File;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/provinces.json");
        $provinces = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($provinces)) {
            throw new \Exception("Il file provinces.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($provinces as $province) {
            if (is_object($province)) { // Assicurati che sia un oggetto
                Province::create([
                    "id" => $province->id,
                    "name" => $province->name,
                    "code" => $province->code,
                    "region_id" => $province->region_id,
                    
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
