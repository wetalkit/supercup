<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ListingPictures;
use App\Helpers\Formatter;

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

    public function contacts()
    {
        return $this->hasMany(ListingContact::class);
    }

    /**
     * Return date_from formatted.
     * 
     * @return string
     */
    public function getDateFromFormattedAttribute()
    {
        return Formatter::formatDate($this->attributes['date_from']);
    }

    /**
     * Return date_to formatted.
     * 
     * @return string
     */
    public function getDateToFormattedAttribute()
    {
        return Formatter::formatDate($this->attributes['date_to'], 'd M Y');
    }
}
