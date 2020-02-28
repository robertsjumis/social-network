<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendInvitation extends Model
{
    protected $fillable = [
        "invite_sender_id", "invite_recipient_id", "accepted_at"
    ];



}
