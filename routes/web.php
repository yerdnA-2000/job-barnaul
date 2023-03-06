<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacanciesController;
use Illuminate\Support\Facades\Route;

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

/* Sitemap */
Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/sitemap/vacancies', [SitemapController::class, 'vacancies']);
Route::get('/sitemap/tags', [SitemapController::class, 'tags']);
/* end Sitemap */

Route::get('/', [VacanciesController::class, 'index'])->name('vacancies');


Route::get('/register', [UserController::class, 'create'])->name('register.create');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/vacancies/show/{id}', [VacanciesController::class, 'show'])->name('vacancies.show');
Route::post('/vacancies/favorites/add', [VacanciesController::class, 'addFavorites'])
    ->name('vacancies.favorites.add');
Route::delete('/vacancies/favorites/delete', [VacanciesController::class, 'deleteFavorites'])
    ->name('vacancies.favorites.delete');

//----Поиск
Route::get('/vacancies/search', [SearchController::class, 'index'])->name('vacancies.search');
Route::get('/vacancies/search/prompt', [SearchController::class, 'getPrompt'])->name('vacancies.search.prompt');
Route::get('/vacancies/tag/{slugTag}', [TagController::class, 'show'])->name('vacancies.search.tag');

Route::group(['middleware' =>  'auth'], function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/my-profile', [UserController::class, 'showMyProfile'])->name('myProfile');
    Route::get('/create-new-vacancy', [VacanciesController::class, 'create'])->name('vacancies.create');
    Route::post('/vacancy-store', [VacanciesController::class, 'store'])->name('vacancies.store');
});

Route::get('/for-employer', [InfoController::class, 'forEmployer'])->name('forEmployer');
Route::get('/legal', [InfoController::class, 'legal'])->name('legal');
Route::get('/contacts', [InfoController::class, 'contacts'])->name('contacts');

Route::post('/subscribe', [MailController::class, 'subscribe'])->name('subscribe');
Route::delete('/unsubscribe', [MailController::class, 'unsubscribe'])->name('unsubscribe');
