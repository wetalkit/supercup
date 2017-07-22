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

    public function setTermsAcceptedAttribute($value)
    {
        $this->attributes['terms_accepted'] = $value == 'on' ? 1 : 0;
    }
}
