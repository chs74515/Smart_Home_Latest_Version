<?php

class DeCONZ_API {
    protected $address = "192.168.1.131:8080";
    protected $key = "/B22BF6B6E7";
    protected $reAuthorize = FALSE;
    protected $endpoint = "";
        
    //<editor-fold desc="Public General API Methods" defaultstate="collapsed">
    public function shouldAuthorize($choice = false){
        $this->reAuthorize = $choice;
    }
    
    public function findGateway(){
        $curl = curl_init("https://dresden-light.appspot.com/discover");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        return curl_exec($curl);
    }
    
    public function aquireAPIKey(){
        $credentials = "ZGVsaWdodDpjaGlzb20="; //base64_encode("delight:chisom");
        $result = $this->curlRequest("POST", "",
            ['devicetype' => 'smart_home_client'],
            ["Authorization: Basic $credentials"]);
        var_dump($result);
        if(isset($result['username'])){
            $this->key = $result['username'];
        }
        echo $this->key;
    }
    //</editor-fold>
    
    //<editor-fold desc="Curl Methods" defaultstate="collapsed">
    public function curlRequest($method, $url_addons = "", $request_body = [], $additionalHeaders = []){
        $url = $this->address . "/api". $this->key. $this->endpoint . $url_addons;
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
