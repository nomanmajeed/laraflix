@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="popular-tv border-b border-gray-800 pb-12">
            <h2 class="uppercase tracking-wider text-red-700 text-lg font-semibold">Popular TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($popularTvShows as $tvshow)
                    <x-tv-card :tvshow=$tvshow :genres=$genres/>
                @endforeach

            </div>
        </div>

        <div class="popular-tv border-b border-gray-800 pt-16">
            <h2 class="uppercase tracking-wider text-red-700 text-lg font-semibold">Top Rated TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($topRatedTvShows as $tvshow)
                    <x-tv-card :tvshow=$tvshow :genres=$genres/>
                @endforeach
                {{-- @foreach ($genres as $gen)
                    {{$gen}}
                @endforeach --}}

            </div>
        </div>
    </div>

@endsection
