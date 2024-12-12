<div>
        @php
        if (str_contains($commercialActivity->logo, 'http')) {
        $urlLogo=$commercialActivity->logo;
        } else {
        $urlLogo=Storage::url($commercialActivity->logo);
        }
        @endphp
    <div>
        <form wire:submit.prevent="submit">
            <button type="submit">Salva</button>
            <div class="flex flex-col p-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="company">Company Name</label>
                    <input wire:model="company" id="company" type="text" value="{{$commercialActivity->company}}">
                </div>
                <div>
                    <select wire:model.live="selectedRegion" id="region" class="m-2 p-2">
                        <option value="">Seleziona la regione</option>
                        @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ $region->id == $selectedRegion ? 'selected' : '' }}>{{ $region->name }}</option>
                        @endforeach
                    </select>


                    <select class="m-2 p-2" wire:model.live="selectedProvince" id="province" {{ !$selectedRegion ? 'disabled' : '' }}>
                        <option value="">Seleziona la provincia</option>
                        @foreach($provinces as $province)
                        <option value="{{ $province->id }}" {{ $province->id == $selectedProvince ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>

                    <select class="m-2 p-2" wire:model.live="selectedCity" id="city" {{ !$selectedProvince ? 'disabled' : '' }}>
                        <option value="">Seleziona la città</option>
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input type="text" wire:model="address" id="address" class="m-2 p-2" placeholder="Indirizzo">
                </div>
                <div>

                    <select class="m-2 p-2" wire:model.live="selectedCategory" id="category">
                        <option value="">Seleziona la categoria</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Small file input</label>
                    <input class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer
                     bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                     wire:model="logo" id="logo" type="file">
                  
                    <img src="{{ $urlLogo }}"  class="max-h-[200px] max-w-[200px]" title="$commercialActivity->company">
                 
                </div>
                <div class="p-2">
                    <label for="rangeKm" class="block  text-sm text-gray-900">Distanza <b>{{$selectedKm}}</b>km</label>
                    <input id="rangeKm" type="range" wire:change="setKm($event.target.value)" min="0" max="60" value="{{$selectedKm}}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                </div>

            </div>
            <div>
                                        
            </div>
        </form>
        <div wire:key="cities-table">
            <table class="border">
                <thead>
                    <tr>
                        <th>Regione</th>
                        <th>Provincia</th>
                        <th>Citta</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citiesRange as $cityRange)
                    <tr class="border">
                        <td class="border">{{$cityRange->province->region->name}}</td>
                        <td class="border">{{$cityRange->province->name}}</td>
                        <td class="border">{{$cityRange->name}}</td>
                        <td class="border">

                            <button class="btn btn-danger" wire:click="removeCity({{ $cityRange->id }})">
                                Rimuovi
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $citiesRange->links() }}
        </div>
    </div>



</div>