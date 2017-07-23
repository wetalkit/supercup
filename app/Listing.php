<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ListingPictures;

class Listing extends Model
{
    protected $table = 'listings';
    protected $guarded = ['id'];

    /**
     * Listing pictures relation.
     * 
     * @return App\ListingPictures
     */
    public function pictures()
    {
        return $this->hasMany(ListingPictures::class);
    }

    /**
     * User relation.
     * 
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Terms Accepted
     * 
     * @param string
     */
    public function setTermsAcceptedAttribute($value)
    {
        $this->attributes['terms_accepted'] = $value == 'on' ? 1 : 0;
    }
}
