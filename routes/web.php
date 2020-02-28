<?php

//main page
Route::middleware("auth", "profile.done")->get('/', 'HomeController@index');

//auth / register / verify pages
Auth::routes(["verify" => true]);

// ?? page
Route::get('/home', 'HomeController@index')->name('home')->middleware("profile.done");

// welcome page for guests
Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");

//posts
Route::middleware("auth", "profile.done")->get("/post/create", "PostController@create")->name("post.create");
Route::middleware("auth", "profile.done")->post("/post", "PostController@store")->name("post.store");
Route::middleware("auth", "profile.done")->get("/post/{post}", "PostController@show")->name("post.show");
Route::middleware("auth", "profile.done")->get("/post/{post}/edit", "PostController@edit")->name("post.edit");
Route::middleware("auth", "profile.done")->put("/post/{post}", "PostController@update")->name("post.update");
Route::middleware("auth", "profile.done")->delete("/post/{post}", "PostController@destroy")->name("post.delete");

//galleries
Route::middleware("auth", "profile.done")->get("/gallery/create", "GalleryController@create")->name("gallery.create");
Route::middleware("auth", "profile.done")->post("/gallery", "GalleryController@store")->name("gallery.store");
Route::middleware("auth", "profile.done")->get("/gallery/{gallery}/edit", "GalleryController@edit")->name("gallery.edit");
Route::middleware("auth", "profile.done")->post("/gallery/{gallery}/image", "ImageController@upload")->name("image.upload");
Route::middleware("auth", "profile.done")->get("/gallery/{gallery}", "GalleryController@show")->name("gallery.show");
Route::middleware("auth", "profile.done")->put("/gallery/{gallery}, GalleryController@update")->name("gallery.update");
Route::middleware("auth", "profile.done")->delete("/gallery/{gallery}, GalleryController@destroy")->name("gallery.delete");

//images
Route::middleware("auth", "profile.done")->get("gallery/{gallery}/{image}", "ImageController@show")->name("image.show");

//friends
Route::middleware("auth", "profile.done")->get("/friends", "FriendController@index")->name("friends.index");
Route::middleware("auth", "profile.done")->post("/friends/{inviteRecipient}", "FriendController@invite")->name("friends.invite");
Route::middleware("auth", "profile.done")->middleware("auth")->delete("/friend/{inviteSender}", "FriendController@rejectInvite")->name("friends.rejectInvite");
Route::middleware("auth", "profile.done")->put("/friends/{sender}", "FriendController@accept")->name("friends.accept");
Route::middleware("auth", "profile.done")->delete("/friends/{friend}", "FriendController@unfriend")->name("friends.delete");

//followers
Route::middleware("auth", "profile.done")->post("/followers/{user}", "FollowerController@store")->name("follower.store");
Route::middleware("auth", "profile.done")->delete("/followers/{user}", "FollowerController@unfollow")->name("follower.delete");

//likes
Route::middleware("auth", "profile.done")->post("/post/{post}/like", "LikeController@likePost")->name("like.post.create");
Route::middleware("auth", "profile.done")->delete("/post/{post}/like", "LikeController@unLikePost")->name("like.gallery.delete");
Route::middleware("auth", "profile.done")->post("/gallery/{gallery}/like", "LikeController@likeGallery")->name("like.gallery.create");
Route::middleware("auth", "profile.done")->delete("/gallery/{gallery}/like", "LikeController@unLikeGallery")->name("like.gallery.delete");

//messages
Route::middleware("auth", "profile.done")->get("/messages", "MessageController@show")->name("message.show");

//user
Route::middleware("auth", "profile.done")->get("/{viewedUser}", "UserController@show")->name("user.profile");
Route::middleware("auth", "profile.done")->put("/{user}", "UserController@updateImage")->name("updateImage.profile");
Route::middleware("auth", "profile.done")->patch("/{user}", "UserController@update")->name("update.profile");
Route::middleware("auth", "profile.done")->patch("/{user}/password", "UserController@updatePassword")->name("updatePassword.profile");
Route::middleware("auth")->get("/{user}/edit", "UserController@edit")->name("edit.profile");
