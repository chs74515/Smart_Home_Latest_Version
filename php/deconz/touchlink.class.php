<?php

class Touchlink extends DeCONZ_API{
    public static function scanForDevices() {
        $ch = curl_init(self::$address . "/api/<apikey>/touchlink/scan");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        return curl_exec($ch);
    }
}
