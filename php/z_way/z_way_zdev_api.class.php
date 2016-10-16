<?php

/*
 *  description
 * 
 *  @category Smart Home Z Way API Project Files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

/**
 * This class allows for access to the Z Way Device API
 * which could allow for sending more dynamic 
 * commands to Z-Way, the virtual Device API should
 * be used for simple commands
 *
 * @author Brody
 */
class Z_Way_zDev_API extends Z_Way_API {
    
    public function buildRequestUrl() {
        return parent::buildRequestUrl() . "ZWaveAPI/";
    }
    
    /**
     * not functional, creates timeout
     * --note: this should have a timestamp on the request, look at pg 31 in zwayDev API guide
     * @return object
     */
    public function retrieveSystemData($num_days = 1){
        $current_timestamp = time();
        $since_timestamp = $current_timestamp - (86400 * $num_days);
        return $this->curlRequest("POST", "Data/{$since_timestamp}");
    }
    
}
