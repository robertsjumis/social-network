<?php

//main page
Route::middleware("auth")->get('/', 'HomeController@index');

//auth / register / verify pages
Auth::routes(["verify" => true]);

// ?? page
Route::get('/home', 'HomeController@index')->name('home')->middleware("profile.done");

// welcome page for guests
Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");

//posts
Route::get("/post/create", "PostController@create")->name("post.create");
Route::post("/post", "PostController@store")->name("post.store");
Route::get("/post/{post}", "PostController@show")->name("post.show");
Route::get("/post/{post}/edit", "PostController@edit")->name("post.edit");
Route::put("/post/{post}", "PostController@update")->name("post.update");
Route::delete("/post/{post}", "PostController@destroy")->name("post.delete");

//galleries
Route::get("/gallery/create", "GalleryController@create")->name("gallery.create");
Route::post("/gallery", "GalleryController@store")->name("gallery.store");
Route::get("/gallery/{gallery}/edit", "GalleryController@edit")->name("gallery.edit");
Route::post("/gallery/{gallery}/image", "ImageController@upload")->name("image.upload");
Route::get("/gallery/{gallery}", "GalleryController@show")->name("gallery.show");
Route::put("/gallery/{gallery}, GalleryController@update")->name("gallery.update");
Route::delete("/gallery/{gallery}, GalleryController@destroy")->name("gallery.delete");

//images
Route::get("gallery/{gallery}/{image}", "ImageController@show")->name("image.show");

//friends
Route::get("/friends", "FriendController@index")->name("friends.index");
Route::post("/friends/{inviteRecipient}", "FriendController@invite")->name("friends.invite");
Route::delete("/friend/{inviteSender}", "FriendController@rejectInvite")->name("friends.rejectInvite");
Route::put("/friends/{sender}", "FriendController@accept")->name("friends.accept");
Route::delete("/friends/{friend}", "FriendController@unfriend")->name("friends.delete");

//followers
Route::post("/followers/{user}", "FollowerController@store")->name("follower.store");
Route::delete("/followers/{user}", "FollowerController@unfollow")->name("follower.delete");

//likes
Route::post("/post/{post}/like", "LikeController@likePost")->name("like.post.create");
Route::delete("/post/{post}/like", "LikeController@unLikePost")->name("like.gallery.delete");
Route::post("/gallery/{gallery}/like", "LikeController@likeGallery")->name("like.gallery.create");
Route::delete("/gallery/{gallery}/like", "LikeController@unLikeGallery")->name("like.gallery.delete");

//messages
Route::get("/messages", "MessageController@show")->name("message.show");

//user
Route::get("/{viewedUser}", "UserController@show")->name("user.profile");
Route::put("/{user}", "UserController@updateImage")->name("updateImage.profile");
Route::patch("/{user}", "UserController@update")->name("update.profile");
Route::patch("/{user}/password", "UserController@updatePassword")->name("updatePassword.profile");
Route::get("/{user}/edit", "UserController@edit")->name("edit.profile");
