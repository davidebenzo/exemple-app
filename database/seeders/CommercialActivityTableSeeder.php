<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\CommercialActivity;
use App\Models\User;
use Exception;
use Faker\Factory as Faker;

use File;

class CommercialActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $faker = Faker::create(); 
            // Decodifica il contenuto del file JSON
            $json = File::get("database/data/address_commercial_activities.json");
            $locations = json_decode($json);
    
            // Controlla che il JSON sia stato decodificato correttamente
            if (!is_array($locations)) {
                throw new \Exception("Il file cities.json non contiene un array valido.");
            }
    
            // Inserisci i dati nella tabella
            foreach ($locations as $location) {
                if (is_object($location)) { // Assicurati che sia un oggetto
                    $city = City::where("name", $location->city)->first();

                    if (!$city) {
                        // Gestione dell'errore: città non trovata
                        throw new Exception("City not found for: " . $location->city);
                    }
                    
                    $category = Category::inRandomOrder()->first();
                    if (!$category) {
                        // Gestione dell'errore: categoria non trovata
                        throw new Exception("No categories found.");
                    }
                    
                    $user = User::inRandomOrder()->first();
                    if (!$user) {
                        // Gestione dell'errore: utente non trovato
                        throw new Exception("No users found.");
                    }
                    
                    $randomNumberCity = $city->id;
                    $randomNumberCategory = $category->id;
                    $randomUser = $user->id;
                    
                    
                    

                    $streetAddress=$location->address;
                    // Genera un indirizzo casuale italiano
                    $address = $streetAddress.", ".$city->name.", Italia";
                    $coordinates = $this->getCoordinates($address);
                    
                    CommercialActivity::create([
                        'company'=>$faker->company,
                        'description'=>$faker->realText(600),
                        'email'=>$faker->companyEmail,
                        'phone'=>$faker->phoneNumber,
                        'logo' =>"https://picsum.photos/" . $faker->numberBetween(200, 500) . "/" . $faker->numberBetween(200, 500),
                        'address'=> $streetAddress,
                        'city_id'=>$randomNumberCity,
                        'rangeKm'=>$faker->numberBetween(1, 30),
                        'category_id'=>$randomNumberCategory,
                        'user_id'=>$randomUser,
                        'latitude'=>$coordinates['lat'],
                        'longitude'=>$coordinates['lng'],
                    ]);
                  
                } else {
                    throw new \Exception("Elemento non valido trovato nel file JSON.");
                }
            }
        }
    }



    


function getCoordinates($address) {
    $apiKey = env('GOOGLE_MAPS_API_KEY', 'AIzaSyB9G5vgpXsEvQE6hJvOVu3oiX8MWawW3f8');
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status'] === 'OK') {
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];
        return ['lat' => $latitude, 'lng' => $longitude];
    } else {
        return ['lat' => '', 'lng' => ''];
    }
}


}
