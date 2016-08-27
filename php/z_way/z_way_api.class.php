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
 * Description of z_way_api
 *
 * @author Brody
 */
class Z_Way_API extends Curl_API{
    
    protected $address = "192.168.1.138";

    protected $port = '8080';
    
    public function buildRequestUrl() {
         return $this->address . ":" . $this->port . "/";
    }

}
