<?php
class Curl {

    public static function get($strUrl, array $attrParams=array()) {
        if ($attrParams) {
            $strUrl .= '?' . http_build_query($attrParams);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $strUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        $out = curl_exec($curl);
        curl_close($curl);
        return $out;
    }

    public static function post($strUrl, array $attrParams=array()) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $strUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $attrParams);
        $out = curl_exec($curl);
    }

} 