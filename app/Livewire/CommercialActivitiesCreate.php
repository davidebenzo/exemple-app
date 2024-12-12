<?php

namespace App\Livewire;

use Livewire\Component;

use App\Livewire\Forms\CommercialActivitiesForm;
use App\Models\CommercialActivity;
use App\Models\Province;
use App\Models\Region;
use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class CommercialActivitiesCreate extends Component
{
    use WithFileUploads;
    use WithPagination;
    public CommercialActivitiesForm $form; 

    public $categories;
    public $companyId;
    public $city;
    public $company;
    public $address;
    public $regions;
    public $logo;
    public $provinces = [];
    public $selectedRegion = null;
    public $selectedProvince = null;
    public $selectedCategory;
    public $selectedKm = null;
    public $cities = [];
    public $selectedCity = null;
    public $searchInput = '';
    public $citiesRemoved=[];
    public $cityIds=null;
    public function mount()
    {
        $this->regions = Region::all();
        $this->categories = Category::all();
        $this->selectedKm=10;
    }

    public function setKm($rangeKm){
        $this->selectedKm =$rangeKm;
      
    }


    public function submit()
    {

        $item = new CommercialActivity();
        $item->company = $this->company;
        $item->address = $this->address;
        $item->city_id = $this->selectedCity;
        $item->category_id = $this->selectedCategory;
        $item->user_id=auth()->id();
        if ($this->logo)
         $this->form->uploadLogo($item,$this->logo);
        $item->save();
        $citiesRangeSelected = $this->form->getCitiesSelectedRange($this->selectedCity, $this->selectedKm, $this->citiesRemoved);
        CommercialActivity::findOrFail($item->id)->deliveryCities()->sync($citiesRangeSelected);
      
        return redirect('/commercial-activities/'.$item->id.'/edit')->with('success', 'Item updated successfully');
    }

 
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
        $this->citiesRemoved = [];
        $this->selectedCity=$cityId;
       
        
    }


    public function render()
    {
        $citiesRange=null;
        if ($this->selectedKm && $this->selectedCity!=''){
            $objCity=City::find($this->selectedCity);
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
        return view('livewire.commercial-activities-create',compact('citiesRange'));
    }
}
  