<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// STRONA GŁÓWNA
Route::get("/", 'IndexController@index')->name('index');

// WYŚWIETLANIE ARTYKUŁU
Route::get('/artykul/{slug}', 'ArticleController@show')->name('article');

// WYŚWIETLANIE KATEGORII ARTYKUŁÓW
Route::get('/{category_slug}', 'ArticleController@index')->where('category_slug', 'aktualnosci|felietony|poradniki|technologie|esport');

// RECENZJE
Route::get('/recenzje', 'ReviewController@index')->name('reviews');
Route::get('/recenzja/{slug}', 'ReviewController@show')->name('review');


// GRY
Route::get('/gry', 'GameController@index')->name('games');
Route::get('/gra/{slug}', 'GameController@show')->name('game');

//FIRMA
Route::get('/firma/{slug}', 'CompanyController@show')->name('company');


// FILMY
Route::get('/filmy', 'VideoController@index')->name('videos');
Route::get('/film/{slug}', 'VideoController@show')->name('video');

// TAGI
Route::get('/tagi', 'TagController@index')->name('tags');
Route::get('/tag/{slug}', 'TagController@show')->name('tag');

// WYSZUKIWANIE

Route::get('/szukaj', [
    'as' => 'search',
    'uses' => 'SearchController@search'
]);

// ## PAGES ## //

// nasz zespół
Route::get('/o-nas', 'IndexController@aboutUs')->name('o-nas');

Route::get('/{slug}', 'PageController@show')->where('slug', 'polityka-prywatnosci|regulamin-serwisu|dolacz-do-nas')->name('page');
Route::get('kontakt', 'PageController@contact')->name('kontakt');

// MAPY STRON SITEMAP
Route::get('/sitemap', 'SitemapController@index');
Route::view('/sitemap/main', 'sitemap.main');
Route::get('/sitemap/articles', 'SitemapController@articles');
Route::get('/sitemap/reviews', 'SitemapController@reviews');
Route::get('/sitemap/games', 'SitemapController@games');
Route::get('/sitemap/videos', 'SitemapController@videos');

Route::feeds();
Route::view('/rss', 'vendor.feeds.rss')->name('rss');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Route::view('/live', 'streams.index');

require __DIR__ . '/profile.php';

Auth::routes([ 'register' => false ]);