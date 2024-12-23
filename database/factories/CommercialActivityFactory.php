<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommercialActivities>
 */
class CommercialActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $locations = [
        ['address' => 'Via Vittorio Emanuele, 7', 'city' => 'Pizzighettone'],
        ['address' => 'Via Bressanoro, 57', 'city' => 'Castelleone'],
        ['address' => 'Via Galilei Galileo, 17', 'city' => 'Codogno'],
        ['address' => 'Via Barbo\', 7', 'city' => 'Soresina'],
        ['address' => 'Via Garibaldi, 19', 'city' => 'Castiglione d\'Adda'],
        ['address' => 'Via Cremona, 34', 'city' => 'Soresina'],
        ['address' => 'Via Alessandro Manzoni, 14/16', 'city' => 'Soresina'],
        ['address' => 'Piazza Guglielmo Marconi, 2/A', 'city' => 'Cremona'],
        ['address' => 'Via Persico, 11/G', 'city' => 'Cremona'],
        ['address' => 'Corso Giuseppe Garibaldi, 40', 'city' => 'Cremona'],
        ['address' => 'Via Giuseppe Taverna, 44/D/E', 'city' => 'Piacenza'],
        ['address' => 'Viale Europa, 33', 'city' => 'Crema'],
        ['address' => 'Via Cavalli Francesco, 55', 'city' => 'Crema'],
        ['address' => 'Viale De Gasperi A., 52', 'city' => 'Crema'],
        ['address' => 'Via Castelleone, 108', 'city' => 'Cremona'],
        ['address' => 'Via Castelleone, 29/E', 'city' => 'Cremona'],
        ['address' => 'Via Emilia Pavese, 40/42', 'city' => 'Piacenza'],
        ['address' => 'Via Ciocca, 30/C', 'city' => 'Quinzano d\'Oglio'],
        ['address' => 'Via Emilia Nord, KM. 280.080', 'city' => 'Casalpusterlengo'],
        ['address' => 'Via Buozzi Bruno, 18', 'city' => 'Casalpusterlengo'],
        ['address' => 'Piazza Marconi Guglielmo, 3', 'city' => 'Cremona'],
        ['address' => 'Via Draghi Giambattista, 10', 'city' => 'Piacenza'],
        ['address' => 'Via Giuseppe Garibaldi, 32', 'city' => 'Como'],
        ['address' => 'Via Cadorna, 162', 'city' => 'Menaggio'],
        ['address' => 'Via della Costituzione, 11', 'city' => 'Mandello del Lario'],
        ['address' => 'Via Provinciale Nord, 1', 'city' => 'Taceno'],
        ['address' => 'Via Tommaso Grossi, 15', 'city' => 'Bellano'],
        ['address' => 'Via Borromeo, 15', 'city' => 'Erba'],
        ['address' => 'Piazza Stazione, 6', 'city' => 'Lecco'],
        ['address' => 'Via Ghislanzoni Antonio, 11/B', 'city' => 'Lecco'],
        ['address' => 'Via La Rosa, 354', 'city' => 'Piantedo'],
        ['address' => 'Via Roma, 56', 'city' => 'Ponte Lambro'],
        ['address' => 'Via alla Fabbrica, 6', 'city' => 'Porlezza'],
        ['address' => 'Via Muller Teodoro, 5', 'city' => 'Lecco'],
        ['address' => 'Via Diaz Armando, 4', 'city' => 'Merone'],
        ['address' => 'Via Cairoli Fratelli, 41', 'city' => 'Lecco'],
        ['address' => 'Largo Caleotto, 31', 'city' => 'Lecco'],
        ['address' => 'Via Vittorio Veneto, 57', 'city' => 'Canzo'],
        ['address' => 'Via Raffaello Sanzio, 2', 'city' => 'Lecco'],
        ['address' => 'Via Ingegner Rinaldo Cabella Lattuada, 41', 'city' => 'Annone di Brianza'],
        ['address' => 'Via Mentana, 45', 'city' => 'Lecco'],
        ['address' => 'Via Brusa Antonio, 4', 'city' => 'Asso'],
        ['address' => 'Corso XXV Aprile, 149', 'city' => 'Erba'],
        ['address' => 'Via Amendola Giovanni, 119', 'city' => 'Lecco'],
        ['address' => 'Via Antica Regina, 111', 'city' => 'Dongo'],
        ['address' => 'Via La Rosa, 354', 'city' => 'Piantedo'],
        ['address' => 'Via Cattaneo Carlo, 42/F', 'city' => 'Lecco'],
        ['address' => 'Via Clerici, 20', 'city' => 'Bulgarograsso'],
        ['address' => 'Via Dell\' Industria, 90', 'city' => 'Cassina Rizzardi'],
        ['address' => 'Via Roma, 29', 'city' => 'Casnate con Bernate'],
        ['address' => 'Via Rova, 29', 'city' => 'Casnate con Bernate'],
        ['address' => 'Via Monte Grappa, 1', 'city' => 'Olgiate Comasco'],
        ['address' => 'Via Roncoroni, 11', 'city' => 'Olgiate Comasco'],
        ['address' => 'Via Ratti Enzo, 2', 'city' => 'Montano Lucino'],
        ['address' => 'Via Garibaldi Giuseppe, 180', 'city' => 'Fino Mornasco'],
        ['address' => 'Via Vittorio Emanuele, 17', 'city' => 'Olgiate Comasco'],
        ['address' => 'Via Garibaldi Giuseppe, 152', 'city' => 'Fino Mornasco'],
        ['address' => 'Via Michelangelo, 33', 'city' => 'Olgiate Comasco'],
        ['address' => 'Via Pasta Giuditta, 2/A', 'city' => 'Como'],
        ['address' => 'Via 1 Maggio, 3', 'city' => 'Montano Lucino'],
        ['address' => 'Via Giuseppe Garibaldi, 32', 'city' => 'Como'],
        // Truncated for brevity...
    ];
    

    public function definition(): array
    {
        $city=City::where('name=>',$this->locations['city'])->get()->first();
        $category=Category::get()->random(1);
        $user=User::get()->random(1);
        
        
        $randomNumberCity = $city[0]->id;
        $randomNumberCategory = $category[0]->id;
        $randomUser = $user[0]->id;
        
        

        $streetAddress=$this->locations['address'];
        // Genera un indirizzo casuale italiano
        $address = $streetAddress.", ".$city[0]->name.", Italia";
        $coordinates = $this->getCoordinates($address);
        return [
            'company'=>$this->faker->company,
            'logo' =>"https://picsum.photos/" . $this->faker->numberBetween(200, 500) . "/" . $this->faker->numberBetween(200, 500),
            'address'=> $streetAddress,
            'description'=> $this->faker->realText(600),
            'phone'=> $this->faker->phoneNumber,
            'email'=> $this->faker->companyEmail,
            'city_id'=>$randomNumberCity,
            'rangeKm'=>$this->faker->numberBetween(1, 30),
            'category_id'=>$randomNumberCategory,
            'user_id'=>$randomUser,
            'latitude'=>$coordinates['lat'],
            'longitude'=>$coordinates['lng'],
        ];
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
