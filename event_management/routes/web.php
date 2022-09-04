<?php

use App\Http\Controllers\EventsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/events', 'App\Http\Controllers\EventsController@index');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/events', 'App\Http\Controllers\EventsController@index')->name('events');
    Route::get('/form', 'App\Http\Controllers\EventsController@form')->name('form');
    Route::post('/add_event', 'App\Http\Controllers\EventsController@add_event')->name('add_event');
    Route::put('/edit_event/{id}', 'App\Http\Controllers\EventsController@edit_event')->name('edit_event');
    Route::delete('/delete_event/{id}', 'App\Http\Controllers\EventsController@delete_event')->name('delete_event');
    Route::resource('event', EventsController::class);
});

// Route::get('/events', function (){
//     return Inertia::render('Events_Management/Events');
// })->name('events');