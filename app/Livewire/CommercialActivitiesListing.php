<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\CommercialActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CommercialActivitiesListing extends Component
{

    public $city_id;

    public $commercialActivities = []; // Elenco delle attività
    public $searchInput = '';     // Valore del filtro
    public $selectedRegion = ''; 
    public $selectedProvince = ''; 
    public $selectedCity = ''; 
    public $selectedKm=''; 

    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function mount()
    {
        $this->commercialActivities = CommercialActivity::with('city')->get();
      
        
    }

    public function updateFilter($data){
 
        $this->searchInput = $data['searchInput'];
        $this->selectedRegion = $data['selectedRegion'];
        $this->selectedProvince = $data['selectedProvince'];
        $this->selectedCity = $data['selectedCity'];
        $this->selectedKm = $data['selectedKm'];
        // Filtra direttamente con la query Eloquent
        $query = CommercialActivity::with('city');

        if ($this->searchInput) {
            $query->where('company', 'like', "%{$this->searchInput}%");
        }

        if ($this->selectedCity) {
            if ($this->selectedKm){
                $objCity=City::find($this->selectedCity);
            
           
                $cityIds = DB::table('cities')
                ->select('id')
                ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$objCity->latitude, $objCity->longitude, $objCity->latitude])
                ->having('distance', '<=', $this->selectedKm)
                ->pluck('id');

                $query = CommercialActivity::with('city')
                ->whereIn('city_id', $cityIds);
              
            } else {
                $query->whereHas('city', function ($query) {
                    $query->where('city_id', $this->selectedCity);
                });
            }
            
        } else if ($this->selectedProvince) {
            $query->whereHas('city', function ($query) {
                $query->whereHas('province', function ($query) {
                    $query->where('province_id', $this->selectedProvince);
                    
                });
            });
        } else if ($this->selectedRegion) {
            $query->whereHas('city', function ($query) {
                $query->whereHas('province', function ($query) {
                    $query->whereHas('region', function ($query) {
                        $query->where('region_id', $this->selectedRegion);
                    });
                });
            });
        }




        $this->commercialActivities = $query
            ->get();
    }


    public function render()
    {
        return view('livewire.commercial-activities-listing');
    }
}
