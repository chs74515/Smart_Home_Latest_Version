<?php

/*
 *  description
 * 
 *  @category resource files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

/**
 * Description of deconz_lights
 *
 * @author Brody
 */
class Lights_Request extends DeCONZ_API{
    protected $endpoint = "/lights";
    protected $fields = [
        "on",
        "bri",
        "hue",
        "sat",
        "ct",
        "xy",
        "alert",
        "effect",
        "transitiontime"
    ];
    
    public function getAllLights(){
        return $this->curlRequest("GET");
    }
    
    public function getLightState($lightId){
        return $this->curlRequest("GET", "/$lightId");
    }
    
    public function deleteLight($lightId){
        return $this->curlRequest("DELETE", "/$lightId");
    }
    
    //need to make this method more detailed, maybe use fields array
    public function setLightState($lightId,$request = []){
        return $this->curlRequest("PUT", "/$lightId/state", $request);
    }
    
    public function turnOffLight($lightId){
        return $this->curlRequest("PUT", "/$lightId/state", ['on' => false]);
    }
    
    public function turnOnLight($lightId){
        return $this->curlRequest("PUT", "/$lightId/state", ['on' => true]);
    }
}
