<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Listing extends Model
{
    /**
     * User relation
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
