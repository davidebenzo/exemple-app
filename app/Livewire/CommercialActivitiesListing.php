<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\CommercialActivity;
use Livewire\Component;
use Livewire\WithPagination;

class CommercialActivitiesListing extends Component
{
    use WithPagination; // Abilita l'impaginazione

    public $city_id;
    public $searchInput = '';
    public $selectedRegion = '';
    public $selectedProvince = '';
    public $selectedCity = '';
    public $selectedKm = '';

    protected $listeners = ['filterUpdated' => 'updateFilter'];

    public function updating($name, $value)
    {
        // Resetta l'impaginazione ogni volta che un filtro cambia
        $this->resetPage();
    }

    public function updateFilter($data)
    {
        $this->searchInput = $data['searchInput'];
        $this->selectedRegion = $data['selectedRegion'];
        $this->selectedProvince = $data['selectedProvince'];
        $this->selectedCity = $data['selectedCity'];
        $this->selectedKm = $data['selectedKm'];

        // Resetta la pagina dopo il filtro
        $this->resetPage();
    }

    public function render()
    {
        // Costruisci la query principale
        $query = CommercialActivity::with('city');

        if ($this->searchInput) {
            $query->where('company', 'like', "%{$this->searchInput}%");
        }

        if ($this->selectedCity) {
            $city = City::find($this->selectedCity);
            $query = $city ? $city->deliveringActivities() : $query;
        } elseif ($this->selectedProvince) {
            $query->whereHas('city.province', function ($q) {
                $q->where('province_id', $this->selectedProvince);
            });
        } elseif ($this->selectedRegion) {
            $query->whereHas('city.province.region', function ($q) {
                $q->where('region_id', $this->selectedRegion);
            });
        }

        // Applica impaginazione
        $commercialActivities = $query->paginate(15); // 15 elementi per pagina

        return view('livewire.commercial-activities-listing', [
            'commercialActivities' => $commercialActivities,
        ]);
    }
}
