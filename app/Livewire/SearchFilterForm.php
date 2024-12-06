<?php

namespace App\Livewire;

use App\Models\City;
use Livewire\Component;
use App\Models\Region;
use App\Models\Province;

class SearchFilterForm extends Component
{
    public $regions;
    public $provinces = [];
    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedKm = null;
    public $cities = [];
    public $selectedCity = null;
    public $searchInput = '';


    public function mount()
    {
        $this->regions = Region::all();
        $this->selectedKm=10;
    }


    public function submit()
    {
        // Emetti un evento con il valore del filtro
       
      
        
        $this->dispatch('filterUpdated', [
            'searchInput' => $this->searchInput,
            'selectedRegion' => $this->selectedRegion,
            'selectedProvince' => $this->selectedProvince,
            'selectedCity' => $this->selectedCity,
            'selectedKm' => $this->selectedKm
        ]);
    }

    public function setKm($rangeKm){

        $this->selectedKm =$rangeKm;
    }

    public function resetFilters() {
        $this->reset(['searchInput', 'selectedRegion', 'selectedProvince', 'selectedCity','selectedKm']);
    }

    public function updatedSelectedRegion($regionId)
    {
        $this->provinces = Province::where('region_id', $regionId)->get();
        $this->selectedProvince = null; // Reset the province selection
    }


    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = City::where('province_id', $provinceId)->get();
        $this->selectedCity = null; // Reset the province selection
    }

    public function render()
    {
        return view('livewire.search-filter-form');
    }
}
