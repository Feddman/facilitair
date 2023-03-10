<x-guest-layout>
    <div class="mt-4 flex justify-center ">
        <div class="md:w-3/4 md:flex flex-row">
            <div x-data="{
                activeImage: '{{$pin->getMedia('images')->first()->getUrl()}}',

            }" class="md:w-1/2">
                <img class="w-full" :src="activeImage" alt="">
                <div class="carousel">
                    <div class="flex flex-wrap">
                        @foreach($pin->getMedia('images') as $image)
                            <div class="w-1/4 p-2">
                                <img @click="activeImage = `{{$image->getUrl()}}`" class="w-full" src="{{$image->getUrl()}}" alt="">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="md:w-1/2 p-4 shadow-inner">
              <div class="flex justify-between">
                <h1 class="text-2xl font-bold">{{$pin->title}}</h1>
                <div x-data="{open: false, confirmDelete: false}" @click.away="open = false" class="relative">
                  <button @click="open =! open" class="text-gray-500 hover:text-gray-600">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                    </svg>
                  </button>
                  <div x-show="open" class="absolute right-0 z-10 w-48 bg-white rounded-md shadow-md mt-1 py-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Delen</a>
                    @auth
                        @if($pin->user_id == Auth::id() || Auth::user()->hasRole('admin'))
                        <a href="{{route('pin.edit', $pin->id)}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Wijzigen</a>
                        <a @click="confirmDelete = true" x-show="!confirmDelete" href="#" class="block px-4 py-2 text-sm text-gray-700 bg-red-400 hover:bg-indigo-500 hover:text-white font-bold">Verwijderen</a>
                        <a @click="confirmDelete = false" x-show="confirmDelete" href="#" class="block px-4 py-2 text-sm text-gray-700 bg-yellow-400 hover:bg-indigo-500 hover:text-white font-bold">Annuleren</a>
                        <form x-show="confirmDelete" method="post" action="{{route('pin.destroy', $pin)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="block px-4 py-2 text-sm text-gray-700 bg-red-500 text-white hover:bg-indigo-500 hover:text-white font-bold">Definitief verwijderen</button>
                        </form>
                        @endif
                    @endauth
                  </div>
                </div>
              </div>
                <div class="pin-info">
                    <p class="text-sm">Geupload door: <b>{{$pin->user->name}}</b></p>
                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Korte beschrijving</h4>
                        <p class="font-roboto text-gray-600">{{$pin->description}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">School</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->school_name ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Locatie in schoolgebouw</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->school_location ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Datum gebruikname</h4>
                        <p class="font-roboto text-gray-600">@if($pin->pinMeta){{Date('d-m-Y', strtotime($pin->pinMeta->datum_gebruikname)) ?? ''}} @endif</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Waarom deze pin</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->reden_bijzonderheid ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Wat gebruikers er over zeggen</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->meningen ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Waar wordt het voornamelijk voor gebruikt?</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->primair_doel ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Overige bijzonderheden?</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->bijzonderheden ?? ''}}</p>
                    </div>

                    <div class="mt-2 description">
                        <h4 class="text-lg font-bold">Betrokken partijen</h4>
                        <p class="font-roboto text-gray-600">{{$pin->pinMeta->betrokkenen ?? ''}}</p>
                    </div>








                </div>


                <div class="meta">
                    <div class="likes">
                        <p>
                            @for($i = 0; $i < $pin->likes->count(); $i++)
                                <x-icon.heart :pin="$pin"></x-icon.heart>
                            @endfor
                            ({{$pin->likes->count()}} likes)
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
