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
    
    public function systemRequest(){
        return parent::curlRequest("GET","system");
    }
    
    public function curlRequest($method, $url_addons = "", $request_body = [], $additionalHeaders = []){
        $session = $this->getZWaySession();
        $modifiedHeaders = array_merge($additionalHeaders,["Accept:application/json", "Content-Type:application/json", "ZWAYSession:$session"]);
        return parent::curlRequest($method, $url_addons, $request_body, $modifiedHeaders);
    }
    
    public function getPlatformStatus(){
        return $this->curlRequest("GET", "status");
    }
    
    public function getDevices(){
        return $this->curlRequest("GET","devices");
    }
    
    public function authenticate(){
        $credentials = ['form'=>true,'keepme'=>false,'login'=>'admin','password'=>'chisom','default_ui'=>1];
        //CURLOPT_COOKIEFILE or http header ZWAYSession=sid from authenticate
        return parent::curlRequest("POST", "login", $credentials, ["Accept:application/json", "Content-Type:application/json"]);
        //will need to obtain 'session' and send it via header or cookie for all requests        
    }
    
    public function getZWaySession(){
        if(!isset($_SESSION['z_way_sess'])){
            $response = $this->authenticate();
            if($response->code == 200){
                $sid = $response->data->sid;
                $_SESSION['z_way_sess'] = $sid;
                return $sid;
            }else{
                echo '<hr>Error with authentication<hr>';
            }
        }else{
            return $_SESSION['z_way_sess'];
        }
    }
    
}
