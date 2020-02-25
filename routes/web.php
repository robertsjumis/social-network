<?php

Route::middleware("auth")->get('/', 'PostController@index');

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

Route::get("/post/create", "PostController@create")->name("post.create");
Route::post("/post", "PostController@store")->name("post.store");
Route::get("/post/{post}", "PostController@show")->name("post.show");
Route::get("/post/{post}/edit", "PostController@edit")->name("post.edit");
Route::put("/post/{post}", "PostController@update")->name("post.update");
Route::delete("/post/{post}", "PostController@destroy")->name("post.delete");


Route::get("/{user}", "UserController@show");
Route::put("/{user}", "UserController@updateImage")->name("updateImage.profile");
Route::patch("/{user}", "UserController@update")->name("update.profile");
Route::get("/{user}/edit", "UserController@edit")->name("edit.profile");



//Route::resource("/{user}", "UserController");
