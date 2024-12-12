<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $city=City::get()->random(1);
        $category=Category::get()->random(1);
        $user=User::get()->random(1);
        
        
        $randomNumberCity = $city[0]->id;
        $randomNumberCategory = $category[0]->id;
        $randomUser = $user[0]->id;
        
        return [
            'company'=>$this->faker->company,
            'logo' =>"https://loremflickr.com/200/200?random={{$this->faker->numberBetween(0, 500)}}",
            'address'=>$this->faker->streetAddress,
            'city_id'=>$randomNumberCity,
            'rangeKm'=>$this->faker->numberBetween(1, 30),
            'category_id'=>$randomNumberCategory,
            'user_id'=>$randomUser
        ];
    }
}
