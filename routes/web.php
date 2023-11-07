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

interface Articles
{
    public function all();
}

class CacheableArticles implements Articles
{
    protected $articles;

    public function __construct(Articles $articles)
    {
        $this->articles = $articles;
    }

    public function all()
    {
        return Cache::remember('articles.all', 60 * 60, function () {
            return $this->articles->all();
        });
    }
}

class EloquentArticles implements Articles
{
    public function all()
    {
        return \App\Models\Article::all();
    }
}

App::bind('Articles', function () {
    return new CacheableArticles(new EloquentArticles);
});

Route::get('/', function (Articles $articles) {
    // dd($articles);

    // $articles = new CacheableArticles(new Articles);
    //
    return $articles->all();
});
