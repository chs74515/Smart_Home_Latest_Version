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
 * Description of zdev_device_request
 *
 * @author Brody
 */
class zDev_Device_Request extends Z_Way_zDev_API{
    
    protected $device_id;

    public function __construct($device_id = "*") {
        $this->device_id = $device_id;
    }
    
    public function buildRequestUrl() {
        return parent::buildRequestUrl() . "devices[$this->device_id].*";
    }
    
}
