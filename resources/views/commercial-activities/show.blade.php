<!DOCTYPE html>
<x-layouts.app>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    @include('layouts.menu')

    <div class="min-h-screen mx-auto bg-white shadow-md overflow-hidden">
        <div class="p-8">
            <!-- Ragione Sociale -->
            <h1 class="text-3xl font-extrabold text-gray-800 mb-4">{{$commercialActivity->company}}</h1>

            <!-- Categoria -->
            <p class="text-gray-600 mt-6">{{$commercialActivity->category->name}}</p>

            @php
            if (str_contains($commercialActivity->logo, 'http')) {
            $urlLogo=$commercialActivity->logo;
            } else {
            $urlLogo=Storage::url($commercialActivity->logo);
            }
            @endphp
            <!-- Immagine -->
            <div class="flex flex-row">
                <!-- Descrizione -->
                <div class="text-gray-600 leading-relaxed mt-6 ">
                    <p>{{$commercialActivity->description}}</p>
                    <h5 class=" mt-4 font-bold">Contatti</h5>
                    <p><b>Mail: </b> <a href="mailto:{{$commercialActivity->email}}">{{$commercialActivity->email}}</p>
                    <p><b>Telefono: </b><a href="tel:{{$commercialActivity->phone}}">{{$commercialActivity->phone}}</a></p>
                </div>
                <div class="mt-6 w-full">
                    <img src="{{$urlLogo}}" alt="Immagine Attività" class="w-72 h-72 mx-auto object-cover rounded-md shadow">
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mt-4">Consegna a domicilio</h2>
            </div>
            <div class="grid gap-4 grid-cols-2">
                <!-- Mappa -->
                <div class="mt-4">

                    <div class="tablet-frame">
                        <div class="tablet-header absolute bg-white text-black text-xs p-2 font-bold">
                            Raggio: {{$commercialActivity->rangeKm}}km</div>
                        <img src="{{asset('img/tablet-frame.png')}}" alt="Cornice Tablet" class="tablet-overlay">
                        <div id="map" class="map-frame"></div>

                    </div>

                </div>

                <div class="mt-4">
                    <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
                        <thead>
                            <tr class="">
                                <th class="p-2 text-left">Regione</th>
                                <th class="p-2 text-left">Provincia</th>
                                <th class="p-2 text-left">Citta</th>
                            </tr>
                            <tr>
                                <th class="p-1 border border-gray-300" colspan="3"><input class="w-full p-1 border border-gray-300" type="text" placeholder="Cerca il tuo Paese "></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($cities as $city)
                            <tr class="odd:bg-gray-100 even:bg-gray-50 hover:bg-blue-100 transition">
                                <td class="p-1 border-b border-gray-300">{{ $city->province->region->name }}</td>
                                <td class="p-1 border-b border-gray-300">{{ $city->province->name }}</td>
                                <td class="p-1 border-b border-gray-300">{{ $city->name }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- Paginazione --}}
                    {{ $cities->links() }}

                </div>
            </div>
        </div>
    </div>




    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Coordinate del centro e raggio in metri
        const center = [{{$commercialActivity->city->latitude}}, {{$commercialActivity->city->longitude}}];

        const radius = {{$commercialActivity->rangeKm*1000}}; // km

        // Inizializzazione della mappa
        const map = L.map('map').setView(center, 11);

        // Aggiunta del layer delle tile
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Aggiunta del marker al centro
        L.marker(center).addTo(map)
            .bindPopup('{{$commercialActivity->company}}').openPopup();

        // Aggiunta del cerchio con il raggio
        L.circle(center, {
            color: 'blue',
            fillColor: '#add8e6',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(map);
    });
</script>










</x-layouts.app>