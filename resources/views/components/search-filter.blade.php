<div class="info p-4 m-4 border-4"
    style="
    background: rgba(0, 0, 0, 0.22);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);
    " >
    <div>
          <h1 class="text-3xl font-bold">Home</h1>
          @if(request()->get('s') || request()->get('t') || request()->get('c'))
          search results for: <span class="font-bold">{{request()->get('s') ?? request()->get('t') ?? \App\Models\Category::find(request()->get('c'))->name}}</span>
            <a class="pl-8 text-indigo-500"href="{{route('welcome')}}">reset zoekfilter</a>
          @endif
          <div class="relative items-center">
            <div>
                <form class="overflow-hidden" action="{{route(request()->route()->getName())}}">
                        <input type="search" name="s" class="bg-gray-100 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-pink-400" placeholder="Zoeken op trefwoord">
                        <input type="submit" value="zoek" class="mt-2 p-2 float-right bg-indigo-400">
                </form>
                <div>
                    <p class="font-bold">Laatste tags:</p>
                    <div class="tags flex flex-wrap gap-2">
                        @foreach(Spatie\Tags\Tag::latest()->take(5)->get() as $tag)
                            <a href="{{route(request()->route()->getName(), ['t' => $tag->name])}}" class="bg-gray-500 text-white px-2 py-1 rounded-lg mt-2">#{{$tag->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="font-bold mt-4">
                     Zoeken op categorie:
                    <form action="{{route(request()->route()->getName())}}">
                        <select onchange="this.form.submit()" offset={-50} class="bg-gray-100 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-pink-400" name="c" id="">
                            <option value="">Selecteer categorie</option>
                            @foreach(\App\Models\Category::getParents() as $category)
                                <optgroup label="{{$category->name}}">
                                    @foreach($category->subcategories as $sub)
                                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
