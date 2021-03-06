<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingPictures extends Model
{
    protected $table = 'listing_pictures';
    protected $guarded = ['id'];


    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}

