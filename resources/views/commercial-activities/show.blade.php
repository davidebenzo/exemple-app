<!DOCTYPE html>
<x-layouts.app>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
   

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
            <div class="mt-6">
                <img src="{{$urlLogo}}" alt="Immagine Attività" class="w-72 h-72 mx-auto object-cover rounded-md shadow">
            </div>

            <!-- Descrizione -->
            <p class="text-gray-600 leading-relaxed mt-6">
                Produciamo dolci artigianali con ingredienti di alta qualità, tramandando le ricette della tradizione italiana con un tocco di innovazione.
            </p>

            <!-- Mappa -->
            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Consegna a domicilio</h2>
                <div id="map" class="w-full h-96 rounded-lg shadow"></div>
            </div>
            <div>
                <table>
                <thead>
                    <tr>
                        <th>Regione</th>
                        <th>Provincia</th>
                        <th>Citta</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> 
                
            @foreach ($cities as $city)
            <tr>  
            <td>{{ $city->province->region->name }}</td>
            <td>{{ $city->province->name }}</td>
            <td>{{ $city->name }}</td>
            </tr>
@endforeach

                </tbody>
</table>
{{-- Paginazione --}}
{{ $cities->links() }}

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
