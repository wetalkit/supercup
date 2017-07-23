<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listings';
    protected $guarded = ['id'];

    public function pictures()
    {
        return $this->hasMany(ListingPictures::class);
    }

    /**
     * User relation
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(ListingContact::class);
    }
}
