<?php

class DeCONZ_API {
    protected static $address = "192.168.1.131:8080";
    protected static $key = "";
    
    public static function findGateway(){
        $curl = curl_init("https://dresden-light.appspot.com/discover");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        return curl_exec($curl);
    }
    
    public static function aquireAPIKey(){
        $credentials = base64_encode("delight:chisom");
        $request_body = json_encode(['devicetype' => 'smart_home_client']);
        $ch = curl_init(self::$address . "/api");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authentication: basic '.$credentials, 'content-type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        var_dump(curl_getinfo($ch));
        return curl_exec($ch);
    }
        
}
