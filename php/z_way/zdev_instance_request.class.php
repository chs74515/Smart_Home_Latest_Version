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
 * Description of zdev_instance_request
 *
 * @author Brody
 */
class zDev_Instance_Request extends Z_Way_zDev_API{
    
    protected $device_id;
    protected $instance_id;

    public function __construct($device_id = "*", $instance_id = null) {
        $this->device_id = $device_id;
        $this->instance_id = $instance_id;
    }
    
    //what if device id hasn't been set and instance id has been?
    public function buildRequestUrl() {
        $request = parent::buildRequestUrl() . "devices[$this->device_id].";
        if(isset($this->instance_id)){
            $request .= "instances[$this->instance_id].*";
        }else{
            $request .= "*";
        }
        return $request;
    }
    
}
