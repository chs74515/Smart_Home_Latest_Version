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
 * Description of curl_api
 *
 * @author Brody
 */
abstract class Curl_API {
    
    protected $address = "192.168.1.131";   
    
    //<editor-fold desc="Curl Methods" defaultstate="collapsed">
    public abstract function buildRequestUrl();    
    
    public function curlRequest($method, $url_addons = "", $request_body = [], $additionalHeaders = []){
        $url = $this->buildRequestUrl() . $url_addons;
        //echo $url . "<br>";
        $ch = curl_init($url);
        if(!empty($request_body)){
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_body));
        }
        if(!empty($additionalHeaders)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $additionalHeaders);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        return json_decode(curl_exec($ch));
    }
    //</editor-fold>  
    
}
