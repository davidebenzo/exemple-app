<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Elenco delle tue attività
        </h2>
    </x-slot>
   
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: { lat: 41.9028, lng: 12.4964 }, // Centro (Roma, Italia)
            });

            // Indirizzi e posizioni
            const addresses = [
                { lat: 41.9028, lng: 12.4964 }, // Roma
                { lat: 45.4642, lng: 9.1900 },  // Milano
                { lat: 40.8518, lng: 14.2681 }, // Napoli
            ];

            // Aggiungi marker
            addresses.forEach((position) => {
                new google.maps.Marker({
                    position,
                    map,
                });
            });
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-row">
                <div class="p-6 text-gray-900 w-1/2 h-100">
                    <table class="table-fixed">
                        <thead>
                            <tr class="border-2">
                                <th class="border-2">Commercial Activity</th>
                                <th class="border-2">Address</th>

                                <th class="border-2"><a href="{{ route('commercial-activities.create') }}" class="btn btn-primary">
                                        Nuova
                                    </a></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($activities as $activity)
                            <tr class="border-2">
                                <td class="border-2">{{$activity->company}}</td>
                                <td class="border-2">{{$activity->city_name}}</td>
                                <td class="border-2">{{$activity->address}}</td>

                                <td class="border-2">
                                    <a href="{{ route('commercial-activities.edit', $activity->id) }}" class="btn btn-primary">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               


   
                    {{$activities->links()}}
                </div>
                <div class="w-1/2" x-data="mapComponent({{ json_encode($addresses) }})" x-init="init()" class="map-container mt-6">
    <div id="map" style="width: 100%; height: 500px;"></div>
</div>

            </div>
        </div>
    </div>

    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
     

        function mapComponent(addresses) {
            console.log(addresses);

            return {
                init() {
                    const map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 6,
                        center: { lat: 41.9028, lng: 12.4964 }, // Centro iniziale (Roma)
                    });

                    // Aggiungi marker dinamicamente
                    addresses.forEach(address => {
                        new google.maps.Marker({
                            position: { lat: parseFloat(address.lat), lng: parseFloat(address.lng) },
                            map: map,
                            title: address.name,
                        });
                    });
                },
            };
        }
    </script>


</x-app-layout>