<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Listing extends Model
{
    protected $table = 'listings';
    protected $guarded = ['id'];

    public function pictures()
    {
        return $this->hasMany(ListingPictures::class);
    }

    public function setTermsAcceptedAttribute($value)
    {
        $this->attributes['terms_accepted'] = $value == 'on' ? 1 : 0;
    }
    /**
     * User relation
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
