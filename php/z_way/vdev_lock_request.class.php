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
 * Description of z_way_lock_request
 *
 * @author Brody
 */
class VDev_Lock_Request extends Z_Way_vDev_API{
    
    public function getAllDoorLocksRequest(){
        return $this->curlRequest("GET","namespaces/devices_doorlock");
    }
    
}
