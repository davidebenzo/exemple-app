<div>
    <div x-data="{ openModal: false, activeCommentId:null }">

        <h3>Commenti</h3>

        @foreach ($comments as $comment)
        <div class="flex flex-col ">
            <div class="flex flex-row">
                <div>

                    <img class="rounded-full mr-2 h-12" src="https://ui-avatars.com/api/?name={{$comment->user->name }}" alt="{{ $comment->user->name }}" />
                    @if ($comment->replies->count()>0)
                    <div
                        class="relative left-6 cursor-none  min-h-[3em] w-0.5 self-stretch bg-neutral-100 dark:bg-white/10"></div>
                    @endif
                </div>
                <div class="flex flex-col">
                    <div class="bg-gray-200 p-2 rounded-md max-w-6xl relative"><strong>{{ $comment->user->name }}</strong> <span class="text-xs">{{$comment->created_at->format('d/m/Y H:i')}}</span>
                        <p>{{ $comment->body }}</p>
                        @if ($comment->reactions->count()>0)
                    <div
                        class=" bg-white border border-blue-500 rounded-md  absolute right-2">{!! '&#128077;' !!}{{$comment->reactions->count()}}</div>
                    @endif
                    </div>
                    <div>
                        @auth
                        <div class=" pl-3">
                            <button @click="activeCommentId = {{ $comment->id }}" type="button" class="pt-2">Rispondi</button>
                        </div>

                        @else
                        <button @click="openModal = true" type="button" class="pt-2">Rispondi</button>
                        @endauth
                    </div>
                </div>


            </div>
            <!-- Commenti figli -->
            @if ($comment->replies->count())
            @php $firstElement = $comment->replies->first(); @endphp


            @if ($comment->replies->count()>1)
            <div class="ml-6 border-l pb-6" x-data="{ isVisible{{ $comment->id }}: false }">
                <div x-show="!isVisible{{$comment->id}}" class="py-3 relative top-10 flex items-center text-sm text-gray-800 
            before:flex-1 before:border-t before:border-gray-200 before:me-6 dark:text-white 
            dark:before:border-neutral-600 w-10 z-0"></div>
                <div x-show="!isVisible{{$comment->id}}" class=" pl-3">
                    <div class="flex flex-row">
                        <div>
                            <img class="rounded-full relative z-10 mr-2 w-12 h-12" src="https://ui-avatars.com/api/?name={{ $firstElement->user->name }}" alt="{{ $firstElement->user->name }}" />
                        </div>

                        <div class="bg-gray-200 p-2 rounded-md max-w-6xl relative">
                            <strong>{{ $firstElement->user->name }}</strong> <span class="text-xs">{{$firstElement->created_at->format('d/m/Y H:i')}}</span>
                            <p>{{ $firstElement->body }}</p>
                            @if ($firstElement->reactions->count()>0)
                    <div
                        class=" bg-white border border-blue-500 rounded-md absolute right-2">{!! '&#128077;' !!}{{$firstElement->reactions->count()}}</div>
                    @endif
                        </div>
                    </div>
                </div>

                <div class="py-3 relative top-6 flex items-center text-sm text-gray-800 
            before:flex-1 before:border-t before:border-gray-200 before:me-6 dark:text-white 
            dark:before:border-neutral-600 w-8 z-0"></div>
                <div @click="isVisible{{$comment->id}} = !isVisible{{$comment->id}}" class="cursor-pointer pl-3">
                    <span x-show="!isVisible{{$comment->id}}"> Visualizza altre {{$comment->replies->count()-1}} riposte</span>
                    <span x-show="isVisible{{$comment->id}}"> Nascondi tutte le riposte</span>
                </div>

                @else
                <div class="ml-6 border-l pb-6" x-data="{ isVisible{{ $comment->id }}: true }">
                    @endif
                    <div x-show="isVisible{{$comment->id}}">
                        @foreach ($comment->replies as $reply)
                        <div class="py-3 relative top-10 flex items-center text-sm text-gray-800 
            before:flex-1 before:border-t before:border-gray-200 before:me-6 dark:text-white 
            dark:before:border-neutral-600 w-10 z-0"></div>
                        <div class=" pl-3">
                            <div class="flex flex-row">
                                <div>
                                    <img class="rounded-full relative z-10 mr-2 w-12 h-12" src="https://ui-avatars.com/api/?name={{ $reply->user->name }}" alt="{{ $reply->user->name }}" />
                                </div>

                                <div class="bg-gray-200 p-2 rounded-md max-w-6xl relative">
                                    <strong>{{ $reply->user->name }}</strong> <span class="text-xs">{{$reply->created_at->format('d/m/Y H:i')}}</span>
                                    <p>{{ $reply->body }}</p>
                                    @if ($reply->reactions->count()>0)
                                        <div
                                        class=" bg-white border border-blue-500 rounded-md  absolute right-2">{!! '&#128077;' !!}{{$reply->reactions->count()}}</div>
                                        @endif
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
                @endif

            </div>
            @endforeach
            @auth
            <div class="py-3 relative top-6 flex items-center text-sm text-gray-800 
            before:flex-1 before:border-t before:border-gray-200 before:me-6 dark:text-white 
            dark:before:border-neutral-600 w-8 z-0"></div>

            <div class=" pl-3">
                <button @click="activeCommentId = 0" type="button" class="pt-2">Scrivi un commento</button>
            </div>

            <form
                x-show="activeCommentId !== null"
                wire:submit.prevent="addComment(activeCommentId)"
                class="w-full mt-4">
                <div class="flex items-center gap-2">
                    <input
                        type="text"
                        wire:model.defer="replyBody.activeCommentId"
                        class="flex-grow p-2 border rounded-lg text-black"
                        placeholder="Scrivi una risposta..." />
                    <button
                        type="submit"
                        class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">



                        Rispondi
                    </button>
                </div>

                <!-- Bottone per chiudere il form -->
                <button
                    type="button"
                    @click="activeCommentId = 0"
                    class="mt-2 text-gray-500 hover:underline">
                    Annulla
                </button>
            </form>
            @else
            <button @click="openModal = true" type="button" class="p-2  rounded-lg  hover:bg-blue-600">Commenta </button>
            @endauth





            <!-- Modale per login/registrazione -->
            <div x-show="openModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <button @click="openModal = false" class="relative top-2 right-2 text-black-400 hover:text-gray-600">
                        x
                    </button>
                    <h2 class="text-lg font-bold mb-4">Accedi o Registrati</h2>
                    <p class="mb-4">Devi essere loggato per rispondere ai commenti. Accedi o registrati per continuare.</p>
                    <div class="flex justify-end">
                        <a href="{{ route('login') }}" class="btn btn-primary mr-2">Accedi</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">Registrati</a>
                    </div>

                </div>
            </div>






        </div>
    </div>