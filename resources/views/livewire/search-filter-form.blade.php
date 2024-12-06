<div>
         <form wire:submit.prevent="submit">
       
    <div class="flex flex-row p-2">
        <div>
           
            <select wire:model.live="selectedRegion" id="region" class="m-2 p-2">
                <option value="">Seleziona la regione</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
           
            <select  class="m-2 p-2" wire:model.live="selectedProvince" id="province" {{ !$selectedRegion ? 'disabled' : '' }}>
                <option value="">Seleziona la provincia</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            
            <select  class="m-2 p-2" wire:model.live="selectedCity" id="city" {{ !$selectedProvince ? 'disabled' : '' }}>
                <option value="">Seleziona la città</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
        <input type="text" wire:model.defer="searchInput" class="m-2 p-2" placeholder="Ricerca per ragione sociale">
        </div>
        <div  class="p-2">
        <label for="rangeKm" class="block  text-sm text-gray-900">Distanza <b>{{$selectedKm}}</b>km</label>
        <input id="rangeKm" type="range" wire:change="setKm($event.target.value)" min="0" max="60" value="{{$selectedKm}}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
        </div>
        <div>
            <button class="m-2 py-2 px-4 btn bg-gray-400 text-white" type="submit">FILTRA</button>
        </div>
        <div>
            <button class="m-2 py-2 px-4 btn bg-gray-400 text-white"  wire:click="resetFilters">RESET</button>
        </div>
    </div>
    </form>
</div>


