<?php

class Touchlink_Request extends DeCONZ_API{
    protected $endpoint = "/touchlink";
    
    public static function scanForDevices() {
        return $this->curlRequest("POST", "/scan");
    }
    
    public static function getScanResults(){
        return $this->curlRequest("GET", "/scan");
    }
}
