<?php 

namespace App\Helpers;

class Location
{
    /**
     * Calculate Walking Distance
     * 
     * @param  float $lat
     * @param  float $long
     * @return array
     */
    public static function calculateWalkingDistance($lat, $long)
    {
        $distance = false;
        $time = false;

        $stadiumGeo = self::getStadiumLatLng();
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s,%s&destinations=%s,%s&mode=walking';
        $url = sprintf($url, $stadiumGeo['lat'], $stadiumGeo['long'], $lat, $long);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);

        if (isset($response_a['rows'][0]['elements'][0]['distance']['value'])) {
            $distance = $response_a['rows'][0]['elements'][0]['distance']['value'];
        }

        if ($response_a['rows'][0]['elements'][0]['duration']['value']) {
            $time = $response_a['rows'][0]['elements'][0]['duration']['value'];
        }
        
        return ['distance' => $distance, 'time' => $time];
    }

    /**
     * Return Skopje stadium geo location
     * 
     * @return array
     */
    public static function getStadiumLatLng()
    {
        return [
            'lat'   => '42.0057531',
            'long'  => '21.4235062'
        ];
    }
}
