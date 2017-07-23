<?php 

namespace App\Helpers;

use DateTime;
use DateInterval;

class Formatter
{
    /**
     * Format Date.
     * 
     * @param  [type]  $date        [description]
     * @param  boolean $includeTime [description]
     * 
     * @return [type]               [description]
     */
    public static function formatDate($date = null, $format = 'd M')
    {
        $date = new DateTime($date);

        return $date->format($format);
    }
}
