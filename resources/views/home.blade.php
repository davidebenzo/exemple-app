<!DOCTYPE html>
<x-layouts.app>
  
<div class="bg-gray-100 text-gray-800">
    @include('layouts.menu')


    <!-- Hero Section -->
    <header class="bg-blue-500 text-white bg bg-hero">
    <div class="h-full w-full bg-black bg-opacity-75">
        <div class="container mx-auto px-4 py-20 text-center">
            <h1 class="text-4xl font-bold mb-4">Ricercafacile.it</h1>
            <p class="text-lg mb-8">Scopri il prodotto perfetto e ricevilo comodamente a casa tua con un clic!</p>
        </div>
        </div>
    </header>
    

    <livewire:search-filter-form />
    <livewire:commercial-activities-listing />


    
</div>
</x-layouts.app>
