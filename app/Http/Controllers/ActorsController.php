<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page=1)
    {
        $popularActors = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/popular?page='.$page)
                        ->json()['results'];

        return view('actors.index', [
            'popularActors' => $popularActors,
            'page' => $page,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id)
                        ->json();

        $social = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/external_ids')
                        ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
                        ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
                        ->json();

        $castCredits = collect($credits)->get('cast');

        $topFiveMovies = collect($castCredits)->where('media_type', 'movie')->sortByDesc('popularity')->take(5);

        // $castCreditsSorted = collect($castCredits)->sortByDesc('release_date');


        $castCreditsSorted = collect($castCredits)->map(function($movie) {
                if (isset($movie['release_date'])) {
                    $releaseDate = $movie['release_date'];
                } elseif (isset($movie['first_air_date'])) {
                    $releaseDate = $movie['first_air_date'];
                } else {
                    $releaseDate = '';
                }

                if (isset($movie['title'])) {
                    $title = $movie['title'];
                } elseif (isset($movie['name'])) {
                    $title = $movie['name'];
                } else {
                    $title = 'Untitled';
                }

                return collect($movie)->merge([
                    'release_date' => $releaseDate,
                    'release_year' => isset($releaseDate) ? \Carbon\Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title' => $title,
                    'character' => isset($movie['character']) ? $movie['character'] : '',
                    'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id']),
                ])->only([
                    'release_date', 'release_year', 'title', 'character', 'linkToPage',
                ]);
            })->sortByDesc('release_date');


        // dump($actor);
        // dump($credits);
        // dump($castCreditsSorted);
        return view('actors.actor', [
           'actor' => $actor,
           'social' => $social,
           'credits' => $castCreditsSorted,
           'topFiveMovies' => $topFiveMovies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
