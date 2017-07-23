<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingContact extends Model
{
    public function booker()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
