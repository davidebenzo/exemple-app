<div>
    <div class="grid grid-cols-3 gap-6 p-4">
        @foreach($commercialActivities as $commercialActivity)
            @php
                $urlLogo = str_contains($commercialActivity->logo, 'http') 
                    ? $commercialActivity->logo 
                    : Storage::url($commercialActivity->logo);
            @endphp
            <div class="border-2 flex rounded-md bg-white shadow">
                <div class="w-[200px] h-[200px] flex-shrink-0 relative"
                     style="background-image: url('{{ $urlLogo }}'); background-size: cover; background-position: center;">
                    <div class="absolute left-0 bottom-0 bg-white border-2">
                        <x-images.category.logo :logo="$commercialActivity->category->logo" class="w-[30px] h-[30px]" />
                    </div>
                </div>
                <div class="flex-grow w-full max-h-[200px] overflow-y grid grid-rows-3 grid-cols-1">
                    <h3 class="font-bold p-2 col-span-full">
                        <a href="{{ route('commercial-activities.show', ['id' => $commercialActivity->id, 'slug' => \Str::slug($commercialActivity->company)]) }}">
                            {{ $commercialActivity->company }}
                        </a>
                    </h3>
                    <div></div>
                    <div class="items-center text-xs p-2 self-end flex h-8 border-t-2 font-semibold">
                        <div class="mr-1">
                            <svg fill="#000000" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 100 100">
                                <g>
                                    <path d="M50,10.417c-15.581,0-28.201,12.627-28.201,28.201c0,6.327,2.083,12.168,5.602,16.873L45.49,86.823
                                    c0.105,0.202,0.21,0.403,0.339,0.588l0.04,0.069l0.011-0.006c0.924,1.278,2.411,2.111,4.135,2.111c1.556,0,2.912-0.708,3.845-1.799
                                    l0.047,0.027l0.179-0.31c0.264-0.356,0.498-0.736,0.667-1.155L72.475,55.65c3.592-4.733,5.726-10.632,5.726-17.032
                                    C78.201,23.044,65.581,10.417,50,10.417z M49.721,52.915c-7.677,0-13.895-6.221-13.895-13.895c0-7.673,6.218-13.895,13.895-13.895
                                    s13.895,6.222,13.895,13.895C63.616,46.693,57.398,52.915,49.721,52.915z" />
                                </g>
                            </svg>
                        </div>
                        <div>
                            @if($selectedCity != '' && $selectedKm == 0)
                                {{ $commercialActivity->address }}
                            @else
                                {{ $commercialActivity->city->name }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controlli di impaginazione -->
    <div class="mt-4">
        {{ $commercialActivities->links() }}
    </div>
</div>
