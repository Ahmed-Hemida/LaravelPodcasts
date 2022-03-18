<?php

use Illuminate\Support\Facades\Route;
use App\Models\podcast;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/podcast/form/view/{id?}', [App\Http\Controllers\AdminController::class, 'podcastForm'])->name('podcast.form.view');
    Route::post('/podcast/create/podcast', [App\Http\Controllers\PodcastController::class, 'createPodcast'])->name('podcast.create');
    Route::post('/podcast/update/podcast', [App\Http\Controllers\PodcastController::class, 'updatePodcast'])->name('podcast.update');
    Route::get('/podcast/index/table', [App\Http\Controllers\PodcastController::class, 'index'])->name('home');
    Route::get('/podcast/{id}/delete', [App\Http\Controllers\PodcastController::class, 'deletePodcast'])->name('podcast.delete');


});
Route::get('/podcast/view', function () {
    $podcasts=podcast::get();
    return view('podcasts_visitor',compact('podcasts'));
});
Route::get('/home', [App\Http\Controllers\PodcastController::class, 'index'])->name('home');
