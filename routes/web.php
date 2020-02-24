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

Route::middleware("auth")->get('/', 'HomeController@index');

Auth::routes(["verify" => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware("profile.done");

Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");





//
Route::get("test-url", function () {
    // šis darbojas ->  return \Illuminate\Support\Facades\Storage::get("public/empty_profile_img.jpeg"); // download metode nokačā failu, url atgriež path to file, delete izdzēš failu
    // īs kkāds kosmosa variants return $user->getPicture();
});

Route::get("/{user}", "UserController@show");
Route::put("/{user}", "UserController@updateImage")->name("updateImage.profile");
Route::patch("/{user}", "UserController@update")->name("update.profile");
Route::get("/{user}/edit", "UserController@edit")->name("edit.profile");



//Route::resource("/{user}", "UserController");
