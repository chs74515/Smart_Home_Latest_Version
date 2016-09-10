<?php

/*
 *  description
 * 
 *  @category Smart Home Project Files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

/**
 * Allows for access to the virtual
 * device API, which is a simpler api than
 * the json api but slightly less dynamic
 *
 * @author Brody
 */
class Z_Way_vDev_API extends Z_Way_API{
    
    public function buildRequestUrl() {
        return parent::buildRequestUrl() . "ZAutomation/api/v1/";
    }
    
    public function authenticate(){
        $credentials = json_encode(['login'=>'admin','password'=>'chisom']);
        return $this->curlRequest("POST", "login", $credentials);
    }
    
}
