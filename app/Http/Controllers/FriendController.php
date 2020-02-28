<?php

namespace App\Http\Controllers;

use App\Follower;
use App\FriendInvitation;
use App\FriendLink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function invite(User $inviteRecipient)
    {
        $inviteSender = auth()->user();

        FriendInvitation::create([
            "invite_sender_id" => $inviteSender->id,
            "invite_recipient_id" => $inviteRecipient->id
        ]);

        return redirect(route("user.profile", $inviteRecipient->slug));
    }

    public function rejectInvite(User $inviteSender)
    {
        $user = auth()->user();

        FriendInvitation::where(["invite_sender_id" => $inviteSender->id], ["invite_recipient_id" => $user->id])->delete();

        return redirect(route("friends.index"));
    }

    public function index()
    {
        $user = auth()->user();

        //gathers friend invitation senders
        $inviteSenders = $user->friendInviteRecipients()->get();

        //gathers friends
        $friends = $user->friendsTo()->get();

        //returns to a view
        return view("friends", [
            "user" => $user,
            "inviteSenders" => $inviteSenders,
            "friends" => $friends
        ]);
    }

    public function accept(User $sender)
    {
        $user = auth()->user();

        // creates two new friend links
        FriendLink::create([
            "friend1_id" => $user->id,
            "friend2_id" => $sender->id
        ]);
        FriendLink::create([
            "friend1_id" => $sender->id,
            "friend2_id" => $user->id
        ]);

        // creates followers to each other
        Follower::create([
            "follower_id" => $user->id,
            "follows_to_id" => $sender->id
        ]);
        Follower::create([
            "follower_id" => $sender->id,
            "follows_to_id" => $user->id
        ]);

        // deletes the friend invitation(s)
        FriendInvitation::where(["invite_sender_id" => $sender->id], ["invite_recipient_id" => $user->id])->delete();
        FriendInvitation::where(["invite_recipient_id" => $sender->id], ["invite_sender_id" => $user->id])->delete();

        return redirect(route("friends.index"));
    }

    public function unfriend(User $friend)
    {
        $user = auth()->user();

        FriendLink::where([
            "friend1_id" => $user->id], [
            "friend2_id" => $friend->id
        ])->delete();
        FriendLink::where([
            "friend1_id" => $friend->id], [
            "friend2_id" => $user->id
        ])->delete();

        Follower::where(["follower_id" => $user->id], ["follows_to_id" => $friend->id])->delete();
        Follower::where(["follower_id" => $friend->id], ["follows_to_id" => $user->id])->delete();

        return redirect(route("user.profile", $friend->slug));

    }


}
