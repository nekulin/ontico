<?php

class GoogleMaps {

    const STATUS_OK = "OK";

    public static function geocode($strAddress) {
        $attrResult = array();
        $strJson = Curl::get('http://maps.googleapis.com/maps/api/geocode/json', array(
            'sensor' => 'true',
            'address' => $strAddress,
        ));
        $result = json_decode($strJson);
        if ($result->status==self::STATUS_OK) {
            if ($result->results) {
                foreach ($result->results as $stdResult) {
                    $attrResult[] = $stdResult->formatted_address;
                }
            }
        }
        return $attrResult;
    }
} 