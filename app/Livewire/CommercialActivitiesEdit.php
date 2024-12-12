<?php

namespace App\Livewire;

use App\Livewire\Forms\CommercialActivitiesForm;
use App\Models\Category;
use App\Models\City;
use App\Models\CommercialActivity;
use App\Models\Province;
use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;



class CommercialActivitiesEdit extends Component
{

    use WithFileUploads;

    use WithPagination;
    public CommercialActivitiesForm $form;

    public $city_id;

    public $companyId;
    public $company;
    public $address;
    public $commercialActivities = []; // Elenco delle attività
    public $searchInput = '';     // Valore del filtro
    public $selectedRegion = '';
    public $selectedProvince = '';
    public $selectedCity = '';
    public $selectedCategory = '';
    public $selectedKm = '';
    public $regions;
    public $categories;
    public $provinces = [];
    public $cities = [];
    public $commercialActivity;
    public $citiesRemoved = [];
    public $logo;  // Variabile per il nuovo logo
    public $cityIds='1';

    // Metodo per caricare la nuova immagine




    public function updatedSelectedRegion($regionId)
    {
        $this->provinces = Province::where('region_id', $regionId)->get();
    }

    public function removeCity($cityId)
    {
        if (!in_array($cityId, $this->citiesRemoved)) {
            $this->citiesRemoved[] = $cityId;
        }
    }

    public function updatedSelectedProvince($provinceId)
    {
        $this->cities = City::where('province_id', $provinceId)->get();
    }

    public function updatedSelectedCity($cityId)
    {
        $this->cityIds=null;
        $this->selectedCity = $cityId;
        
    }

    public function mount(CommercialActivity $commercialActivity)
    {
        $this->companyId = $commercialActivity->id;
        $this->company = $commercialActivity->company;
        $this->address = $commercialActivity->address;
        $this->regions = Region::all();
        $this->categories = Category::all();
        $this->selectedCity = $commercialActivity->city->id;
        $this->selectedCategory = $commercialActivity->category->id;
        $city = City::find($this->selectedCity);
        $this->selectedKm = $commercialActivity->rangeKm;



        $province = Province::find($city->province_id);
        $this->selectedProvince = $province->id;

        $region = Region::find($province->region_id);
        $this->selectedRegion = $region->id;
        if ($this->selectedRegion) {
            $this->provinces =  $this->form->updatedSelectedRegion($this->selectedRegion);
        }

        if ($this->selectedProvince) {
            $this->cities = $this->form->updatedSelectedProvince($this->selectedProvince);
        }

        $this->commercialActivity = $commercialActivity;
    }




    public function submit()
    {
        $item = CommercialActivity::find($this->companyId);
        $item->company = $this->company;
        $item->address = $this->address;
        $item->city_id = $this->selectedCity;
        $item->category_id = $this->selectedCategory;
        if ($this->logo)
            $this->form->uploadLogo($item, $this->logo);
        $citiesRangeSelected = $this->form->getCitiesSelectedRange($this->selectedCity, $this->selectedKm, $this->citiesRemoved);
        CommercialActivity::findOrFail($item->id)->deliveryCities()->sync($citiesRangeSelected);
        $item->save();
        return redirect('/commercial-activities/' . $this->companyId . '/edit')->with('success', 'Item updated successfully');
    }






    public function setKm($rangeKm)
    {
        $this->selectedKm = $rangeKm;
        $this->cityIds=null;
    }




    public function render()
    {
        $item = CommercialActivity::find($this->companyId);
        $objCity = City::find($this->selectedCity);
        if ($item->deliveryCities()->count() > 0 && $this->cityIds!=null) {
         
            $this->cityIds = $item->deliveryCities()->pluck('city_id');
            $citiesRange  = City::query()
                ->with(['province.region']) // Carica le relazioni province e region
                ->select('cities.*')
                ->selectRaw(
                    "(6371 * acos(cos(radians(?)) * cos(radians(cities.latitude)) * cos(radians(cities.longitude) - radians(?)) + sin(radians(?)) * sin(radians(cities.latitude)))) AS distance",
                    [$objCity->latitude, $objCity->longitude, $objCity->latitude]
                )
                ->having('distance', '<=', $this->selectedKm)
                ->join('provinces', 'cities.province_id', '=', 'provinces.id')
                ->join('regions', 'provinces.region_id', '=', 'regions.id')
                ->orderBy('regions.name')
                ->whereIn('cities.id', $this->cityIds)
                ->paginate(10);
        } else {
            $citiesRange  = City::query()
                ->with(['province.region']) // Carica le relazioni province e region
                ->select('cities.*')
                ->selectRaw(
                    "(6371 * acos(cos(radians(?)) * cos(radians(cities.latitude)) * cos(radians(cities.longitude) - radians(?)) + sin(radians(?)) * sin(radians(cities.latitude)))) AS distance",
                    [$objCity->latitude, $objCity->longitude, $objCity->latitude]
                )
                ->having('distance', '<=', $this->selectedKm)
                ->join('provinces', 'cities.province_id', '=', 'provinces.id')
                ->join('regions', 'provinces.region_id', '=', 'regions.id')
                ->orderBy('regions.name')
                ->whereNotIn('cities.id', $this->citiesRemoved) // Escludi le città rimosse
                ->paginate(10);
        }
        return view('livewire.commercial-activities-edit', compact('citiesRange', 'objCity'));
    }
}
