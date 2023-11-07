<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return Cache::remember('articles.all', 60 * 60, function() {
        return \App\Models\Article::all();
    });


    // return remember('articles.all', 60 * 60, function() {
    //     return \App\Models\Article::all();
    // });
});

// function remember($key, $minutes, $callback) {
//     if($value = Redis::get($key)) {
//         return json_decode($value);
//     }
//
//     Redis::setex($key, $minutes, $value = $callback());
//
//     return $value;
// }
