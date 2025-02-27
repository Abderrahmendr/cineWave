<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class MoviesController extends Controller
{
    //


    public function index()
    {

        
        $apiKey = env('TMDB_API_KEY');

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/now_playing?api_key='.$apiKey)
        ->json()['results'];

        $topRated = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/top_rated?api_key='.$apiKey)
        ->json()['results'];

        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular?api_key='.$apiKey )
        ->json()['results'];

        $upcoming = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/upcoming?api_key='.$apiKey )
        ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=3e0a917baa2ad47e37244f4af42b4eb0' )
        ->json()['genres'];



        return view('movie.index',[

            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'topRated'=>$topRated,
            'upcoming' =>$upcoming,
            'genres' => $genres,

        ]);
    }

                                              //SHOW FUNCTION

    public function show($id)
    {
        $apiKey = env('TMDB_API_KEY');

        $movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$apiKey.'&append_to_response=credits,videos,images')
        ->json();

 
        return view('movie.show', compact('movie'));

    }
}

