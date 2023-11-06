<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
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

Route::get('videos/{id}', function ($id) {
    $downloads = Redis::get("videos.{$id}.download");

    return view('welcome', compact('downloads'));
});

Route::get('videos/{id}/downloads', function($id) {
    // Prepare the download.

    Redis::incr("videos.{$id}.download");

    return back();
});



Route::get('articles/trending', function() {
    $trending = Redis::zrevrange('trending_articles', 0, 2);

    $trending = \App\Models\Article::hydrate(
        array_map('json_decode', $trending)
    );

    dd($trending);
    // return $trending;
});


Route::get('articles/{article}', function(\App\Models\Article $article) {
    Redis::zincrby('trending_articles', 1, $article);

    return $article;
});
