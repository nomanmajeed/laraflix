<div class="relative mt-3 md:mt-0" x-data="{isOpen : true}" @click.away="isOpen=false" @keydown.escape="isOpen=false">
    <input wire:model.debounce.500="search"
        class="text-sm bg-white text-black rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline"
        type="text" name="search" id="search" placeholder="Search Movie" @focus="isOpen=true">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-black mt-2 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>
    
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute"></div>

    @if ($search != "")
        <div class="z-50 absolute bg-black text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-red-700 px-3 py-3 flex items-center">
                                @if ($result['poster_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92' . $result['poster_path'] }}" alt="poster" class="w-8">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}</span>  
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">
                        No Results Found for "{{$search}}"
                </div>
            @endif 
        </div>
    @endif
    
</div>
