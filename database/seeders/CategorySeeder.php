<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

use File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Decodifica il contenuto del file JSON
        $json = File::get("database/data/categories.json");
        $categories = json_decode($json);

        // Controlla che il JSON sia stato decodificato correttamente
        if (!is_array($categories)) {
            throw new \Exception("Il file categories.json non contiene un array valido.");
        }

        // Inserisci i dati nella tabella
        foreach ($categories as $category) {
            if (is_object($category)) { // Assicurati che sia un oggetto
                Category::create([
                    "name" => $category->name,
                    "logo" => trim("images/category/".strtolower(str_replace("&","-",trim($category->name)))).".blade.php",
                    
                ]);
            } else {
                throw new \Exception("Elemento non valido trovato nel file JSON.");
            }
        }
    }
}
