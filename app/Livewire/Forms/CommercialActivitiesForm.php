<?php

namespace App\Livewire\Forms;

use App\Models\City;
use App\Models\CommercialActivity;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class CommercialActivitiesForm extends Form
{
    
    use WithFileUploads;


    public $citiesRemoved=[];

 public function updatedSelectedRegion($regionId)
    {
        return Province::where('region_id', $regionId)->get();
       
    }

    public function removeCity($cityId)
    {
        if (!in_array($cityId, $this->citiesRemoved)) {
            return $cityId;
        }      
       
    }
    
    public function updatedSelectedProvince($provinceId)
    {
        return City::where('province_id', $provinceId)->get();    
    }

    public function updatedSelectedCity($cityId)
    {
        return $cityId;
       
        
    }


    public function uploadLogo(CommercialActivity $commercialActivity, $logo)
    {
        // Validazione manuale

        if (!$logo->isValid() || !$logo->isFile()) {
            throw new \Exception('Il file non è valido.');
        }
    
        if (!in_array($logo->extension(), ['jpeg', 'png', 'jpg']) || $logo->getSize() > 10240 * 1024) {
            throw new \Exception('Il file deve essere un\'immagine valida e non superare i 10MB.');
        }
    
        // Elimina l'immagine precedente se esiste
        if ($commercialActivity->logo && Storage::exists('public/' . $commercialActivity->logo)) {
            Storage::delete('public/' . $commercialActivity->logo);
        }
    
        // Carica il nuovo file
        $path = $logo->store('logos', 'public');
    
        // Aggiorna il record
        $commercialActivity->logo = $path;
        $commercialActivity->save();
    }

    public function getCitiesSelectedRange($selectedCity,$selectedKm,$citiesRemoved){
        $objCity=City::find($selectedCity);
        $citiesRange = DB::table('cities')
        ->select('id')
        ->selectRaw(
            "(6371 * acos(cos(radians(?)) * cos(radians(cities.latitude)) * cos(radians(cities.longitude) - radians(?)) + sin(radians(?)) * sin(radians(cities.latitude)))) AS distance",
            [$objCity->latitude, $objCity->longitude, $objCity->latitude]
        )
        ->having('distance', '<=', $selectedKm)
        ->whereNotIn('id', $citiesRemoved)
        ->pluck('id');
        return $citiesRange;
    }


}
