<div>
<div class="mt-4">
                    <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
                        <thead>
                            <tr class="">
                                <th class="p-2 text-left">Regione</th>
                                <th class="p-2 text-left">Provincia</th>
                                <th class="p-2 text-left">Citta</th>
                            </tr>
                            <tr>
                                <th class="p-1 border border-gray-300" colspan="3">
                               
                                    <input class="w-full p-1 border border-gray-300" type="text"  wire:model.live="search" 
                                  
                                    placeholder="Cerca il tuo Paese "></th>

                                    
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($cities) > 0)
                            @foreach ($cities as $city)
                            <tr class="odd:bg-gray-100 even:bg-gray-50 hover:bg-blue-100 transition">
                                <td class="p-1 border-b border-gray-300">{{ $city->province->region->name }}</td>
                                <td class="p-1 border-b border-gray-300">{{ $city->province->name }}</td>
                                <td class="p-1 border-b border-gray-300">{{ $city->name }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr class="odd:bg-gray-100 even:bg-gray-50 hover:bg-blue-100 transition">
                            <td colspan="3" class="p-1 border-b border-gray-300">Non ci sono città disponibili.</td>
                        </tr>
                            
                        @endif
                        </tbody>
                    </table>
                    {{-- Paginazione --}}
                    {{ $cities->links() }}

                </div>
</div>
