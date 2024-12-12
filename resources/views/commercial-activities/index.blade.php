<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Elenco delle tue attività
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <table class="table-fixed">
  <thead>
    <tr>
      <th>Song</th>
      <th>Artist</th>
      <th>Year</th>
      <th><a href="{{ route('commercial-activities.create') }}" class="btn btn-primary">
                Nuova
            </a></th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($activities as $activity)
    <tr>
      <td>{{$activity->company}}</td>
      <td>{{$activity->address}}</td>
      <td>1961</td>
      <td>
      <a href="{{ route('commercial-activities.edit', $activity->id) }}" class="btn btn-primary">
                Modifica
            </a>
      </td>
    </tr>
              @endforeach
  </tbody>
</table>
             
                </div>
            </div>
        </div>
    </div>

    <script>
    function navigateTo(url) {
        window.location.href = url;
    }
</script>


</x-app-layout>
