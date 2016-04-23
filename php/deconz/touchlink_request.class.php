<?php

class Touchlink_Request extends DeCONZ_API{
    protected $endpoint = "/touchlink";
    
    public function scanForDevices() {
        return $this->curlRequest("POST", "/scan");
    }
    
    public function getScanResults(){
        return $this->curlRequest("GET", "/scan");
    }
}
