<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Http\Requests\UploadImage;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(User $user) // shows edit page
    {
        $authUser = auth()->user();

        $this->authorize('updateUser', [$user, $authUser]);

        return view('/users/edit', ["user" => $user, "authUser" => $authUser]);
    }

    public function show(User $viewedUser) // shows user's profile page
    {
        $user = auth()->user();

        $followerIds = DB::table("followers")
            ->select("follower_id")
            ->where("follows_to_id", "=", $viewedUser->id)->get();

        $showFollowButton = true;
        if ($followerIds->contains('follower_id', $user->id)) {
            $showFollowButton = false;
        }

        $friendsIds = DB::table("friend_links")
            ->select("friend1_id")
            ->where("friend2_id", "=", $viewedUser->id)->get();

        $invitedFriends = DB::table("friend_invitations")
            ->select("invite_recipient_id")
            ->where("invite_sender_id", "=", $user->id)->get();

        $showFriendInviteButton = true;
        if ($friendsIds->contains('friend1_id', $user->id) || !$invitedFriends->contains("invite_recipient_id", $user->id)) {
            $showFriendInviteButton = false;
        }

        $showUnfriendButton = false;
        if ($friendsIds->contains('friend1_id', $user->id)) {
            $showUnfriendButton = true;
        }

        $showEditProfileButton = $user == $viewedUser ? true : false;

        //gathers friends
        $friends = $viewedUser->friendsTo()->get();

        //gathers galleries
        $galleries = $viewedUser->galleries()->orderBy("created_at", "desc")->get();

        //gathers posts
        $posts = Post::where("created_by", $viewedUser->id)->orderBy("created_at", "desc")->get();

        return view("/users/profile", [
            "user" => $user,
            "viewedUser" => $viewedUser,
            "showFollowButton" => $showFollowButton,
            "showUnfriendButton" => $showUnfriendButton,
            "showFriendInviteButton" => $showFriendInviteButton,
            "showEditProfileButton" => $showEditProfileButton,
            "friends" => $friends,
            "galleries" => $galleries,
            "posts" => $posts
        ]);
    }

    public function updateImage(UploadImage $request, User $user) // post request in edit page
    {
        $authUser = auth()->user();

        $this->authorize('updateUser', [$user, $authUser]);

        $user->update([
            "image_location" => request()->file("image")->store("profile_pictures", "public")
        ]);

        $user->save();

        return redirect(route("edit.profile", ["user" => $user]));
    }

    public function update(User $user)
    {
        $authUser = auth()->user();

        $this->authorize('updateUser', [$user, $authUser]);

        $user->update([
            "name" => request()->name,
            "last_name" => request()->last_name,
            "email" => request()->email,
            "address" => request()->address,
            "phone" => request()->phone,
            "bio" => request()->bio,
            "birthday" => request()->birthday,
            "slug" => request()->name . request()->last_name . "-" . $user->id,
            "updated_at" => NOW()
        ]);

        Follower::create([
            "follower_id" => $user->id,
            "follows_to_id" => $user->id
        ]);

        return redirect(route("edit.profile", ["user" => $user]));
    }

    public function updatePassword(User $user)
    {
        $authUser = auth()->user();

        $this->authorize('updateUser', [$user, $authUser]);

        $user->update([
            'password' => Hash::make(request()->password),
        ]);
        return redirect(route("edit.profile", ["user" => $user]));
    }

}
