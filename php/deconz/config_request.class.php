<?php

/**
 *  description
 * 
 *  @category deconz api files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

class Config_Request extends DeCONZ_API{
    protected $endpoint = "/config";
    
    public function openNetwork($time = 60){
        $this->curlRequest("PUT","",['permitjoin'=>$time]);
    }
    
    public function closeNetwork(){
        $this->curlRequest("PUT","",['permitjoin'=>0]);
    }
}
