    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class=""><h1 class="text-2xl font-bold text-black-500">Ricercafacile.it</h1></a>
            <ul class="flex space-x-4">
                @if (Auth::User())
                <li><a href="{{route('profile.edit')}}" class="text-gray-600 hover:text-blue-500">Profilo</a></li>
                <li><a href="{{route('logout')}}" class="text-gray-600 hover:text-blue-500">Logout</a></li>
                @else
                <li><a href="{{route('register')}}" class="text-gray-600 hover:text-blue-500">Registrati</a></li>
                <li><a href="{{route('login')}}" class="text-gray-600 hover:text-blue-500">Login</a></li>
                @endif
                
            </ul>
        </div>
    </nav>