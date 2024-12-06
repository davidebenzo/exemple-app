<!DOCTYPE html>
<x-layouts.app>
  
<div class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-blue-500">MyWebsite</a>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-gray-600 hover:text-blue-500">Home</a></li>
                <li><a href="#" class="text-gray-600 hover:text-blue-500">About</a></li>
                <li><a href="#" class="text-gray-600 hover:text-blue-500">Services</a></li>
                <li><a href="#" class="text-gray-600 hover:text-blue-500">Contact</a></li>
            </ul>
        </div>
    </nav>

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
