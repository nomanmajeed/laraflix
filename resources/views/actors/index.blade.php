@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="popular-actors border-b border-gray-800 pb-12">
            <h2 class="uppercase tracking-wider text-red-700 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                        <div class="actor mt-8">
                            <a href="{{ route('actors.show', $actor['id']) }}">
                                @if ($actor['profile_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w500' . $actor['profile_path'] }}">
                                @else
                                    <img src="{{ 'https://ui-avatars.com/api/?size=235&name='.$actor['name'] }}">
                                @endif
                                
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('actors.show', 1) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                                <div class="text-sm truncate text-gray-400">
                                    @foreach ($actor['known_for'] as $media)
                                        @if ($media['media_type'] == 'movie')
                                            {{ $media['title'] }}@if (!$loop->last)
                                            ,
                                        @endif
                                        @elseif ($media['media_type'] == 'tv')
                                            {{ $media['name'] }}@if (!$loop->last)
                                            ,
                                        @endif
                                        @endif
                                        {{-- {{ $media['media_type'] }} --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>                   
                @endforeach
            </div>
        </div>
        <div class="flex justify-between mt-8 mb-8"> 
            @if ($page == 1)
                <a href="/actor/page/{{ $page+1 }}">Next</a>
            @elseif($page <=100)
                <a href="/actor/page/{{ $page-1 }}">Previous</a>
            @endif
            @if ($page != 1 & $page<100) 
                <a href="/actor/page/{{ $page+1 }}">Next</a>
            @endif
        </div>
    </div>

@endsection
