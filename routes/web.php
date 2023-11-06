<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    // $user3Stats = [
    //     'favorites' => 10,
    //     'watchLaters' => 20,
    //     'completions' => 35,
    // ];
    //
    // \Illuminate\Support\Facades\Redis::hmset('user.3.stats', $user3Stats);

    // return \Illuminate\Support\Facades\Redis::hgetall('user.1.stats');

    Cache::put('foo', 'bar', 10);

    return Cache::get('foo');
});

Route::get('/users/{id}/stats', function ($id) {
    return \Illuminate\Support\Facades\Redis::hgetall("user.{$id}.stats");
});

Route::get('favorite-video', function() {
    \Illuminate\Support\Facades\Redis::hincrby('user.1.stats', 'favorites', 1);

    return redirect('/');
});
