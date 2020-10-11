@extends('layouts.main')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row">
            <img src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}" alt="" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current w-4 text-red-700 mr-1" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>{{ $movie['vote_average'] * 10 . '%' }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach ($movie['genres'] as $genre)
                            {{ $genre['name'] }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </span>
                </div>

                <div class="mt-6">
                    <div class="flex mt-4">
                        <div>
                            <div> Movie Tagline <p class="text-gray-600 font-semibold pr-3">{{ $movie['tagline'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex mt-4">
                        <div>
                            <div> Description</div>
                            <p class="text-gray-600">{{ $movie['overview'] }} </p>
                        </div>
                    </div>
                </div>



                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 2)
                                <div class="mr-8">
                                    <div class="text-gray-600">{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @else
                                @break
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="mt-12" x-data="{isModalOpen: false}">
                    @if (count($movie['videos']['results']) > 0)
                        <button @click="isModalOpen=true" @keydown.escape="isModalOpen=false" class="flex inline-flex items-center bg-red-700 text-gray-900 font-semibold px-5 py-4 
                                rounded hover:bg-red-500 transition ease-in-out duration-150">

                            <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-2 font-semibold">Play Trailer</span>
                        </button>
                    @endif
                    
                    @if (count($movie['videos']['results']) > 0)
                        <div x-show.transition.opacity="isModalOpen" style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isModalOpen = false" @keydown.escape.window="isModalOpen = false"
                                            class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 5)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id']) }}">
                                @if ($cast['profile_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $cast['profile_path'] }}" alt="cast"
                                        class="hover:opacity-75 transition ease-in-out duration-150" />
                                @else
                                    <img src="{{ 'https://ui-avatars.com/api/?size=512&name=' . $cast['name'] }}" alt="cast"
                                        class="hover:opacity-75 transition ease-in-out duration-150 " />
                                @endif

                            </a>
                            <div class="mt-2">
                                <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300"> {{ $cast['name'] }} </a>
                                <div class="flex items-center text-gray-400 text-sm mt-1">
                                    <span>{{ $cast['character'] }}</span>
                                </div>
                            </div>
                        </div>
                    @else
                        @break
                    @endif
                @endforeach

            </div>
        </div>


    </div>

    <div class="movie-images border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>

            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($movie['images']['backdrops'] as $screenshot)
                    @if ($loop->index < 12)
                        <div class="mt-8">
                            <a href="#">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500' . $screenshot['file_path'] }}" alt=""
                                    class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                        </div>
                    @else
                        @break
                    @endif

                @endforeach

            </div>
        </div>


    </div>

@endsection
