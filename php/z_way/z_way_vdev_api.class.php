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
    
    /**
     * @deprecated should use getDeviceNamespace instead, result is alot cleaner
     * @return type
     */
    public function getDevices(){
        return $this->curlRequest("GET","devices");
    }
    
    public function getDeviceNamespace(){
        return $this->curlRequest("GET","namespaces/devices_all");
    }
    
    public function getDeviceById($id){
        return $this->curlRequest("GET","devices/{$id}");
    }
    
    public function getDeviceMetrics($id){
        $result = $this->getDeviceById($id);
        if(isset($result->data->metrics)){
            return $result->data->metrics;
        }else{
            echo "<hr>Could not get metrics for device: '{$id}'<hr>";
            return []; //metrics object didn't exist return empty array
        }
    }
    
    public function sendCommand($id, $command){
        //note: commands have to be sent by GET
        return $this->curlRequest("GET","devices/{$id}/command/{$command}");
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
