<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ListingPictures;
use App\Helpers\Formatter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use SoftDeletes;

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
    
    public function getDefaultImageSrcAttribute()
    {
        if ($image = $this->pictures->first()) {
            return $image->picture;
        }
        return false;
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
        return Formatter::formatDate($this->attributes['date_to'], 'd M');
    }

    /**
     * Distance
     * @return string
     */
    public function getDistanceFormattedAttribute()
    {
        if ($this->attributes['distance_stadium_time'] < 1*60*60) {
            return round($this->attributes['distance_stadium_time']/60).' mins walk';
        } else {
            return round($this->attributes['distance_stadium']/1000).' km';
        }

        return false;
    }
}
