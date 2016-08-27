<?php

class DeCONZ_API extends Curl_API{
    protected $address = "192.168.1.131";
    protected $port = "8080";
    protected $key = "/B22BF6B6E7";
    protected $reAuthorize = FALSE;
    protected $endpoint = "";
    
    public function buildRequestUrl() {
        return $this->address . ":" . $this->port . "/api". $this->key. $this->endpoint;
    }

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
    
    
}
