<?php

namespace App\Http\Controllers;

use App\FriendInvitation;
use App\FriendLink;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function invite(int $inviteRecipientId)
    {
        $inviteSender = auth()->user();

        FriendInvitation::create([
            "invite_sender_id" => $inviteSender->id,
            "invite_recipient_id" => $inviteRecipientId
        ]);

        return redirect(route("user.profile", $inviteRecipientId));
    }

    public function index()
    {
        $user = auth()->user();

        //gathers invitations
        $invitationSenderIds = FriendInvitation::where('invite_recipient_id', $user->id)
            ->pluck('invite_sender_id')
            ->toArray();

        $invitationSenders = [];

        foreach ($invitationSenderIds as $invitationSenderId) {
            $invitationSenders[] = User::find($invitationSenderId);
        }

        //gathers friends
        $friendsIds = FriendLink::where("friend1_id", $user->id)
            ->pluck("friend2_id")
            ->toArray();

        $friends = [];

        foreach ($friendsIds as $friendId) {
            $friends[] = User::find($friendId);
        }

        //returns to a view
        return view("friends", [
            "user" => $user,
            "invitationSenders" => $invitationSenders,
            "friends" => $friends
        ]);
    }

    public function accept(int $senderId)
    {
        $user = auth()->user();

        // creates two new friend links

        FriendLink::create([
            "friend1_id" => $user->id,
            "friend2_id" => $senderId
        ]);
        FriendLink::create([
            "friend1_id" => $senderId,
            "friend2_id" => $user->id
        ]);

        // deletes the friend invitation
        FriendInvitation::where(["invite_sender_id" => $senderId], ["invite_recipient_id" => $user->id])->delete();
        FriendInvitation::where(["invite_recipient_id" => $senderId], ["invite_sender_id" => $user->id])->delete();

        return redirect(route("friends.index"));
    }


}
