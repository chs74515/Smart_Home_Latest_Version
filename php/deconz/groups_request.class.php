<?php

/** 
 *  @category deconz api
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

class Groups_Request extends DeCONZ_API{
    protected $endpoint = "/groups";
    
    public function createGroup($name){
        $fields = ['name' => $name];
        return $this->curlRequest("POST","",$fields);
    }
    
    public function getGroups(){
        return $this->curlRequest("GET");
    }
    
    public function getGroupAttributes($id){
        return $this->curlRequest("GET", "/$id");
    }
    
    public function setGroupAttributes($id, $fields){
        return $this->curlRequest("PUT", "/$id", $fields);
    }
    
    public function setGroupName($id, $name){
        $fields = ['name' => $name];
        return $this->setGroupAttributes($id, $fields);
    }
    
    public function setGroupLights($id, $lights){
        $fields = ['lights' => $lights]; //array of light ids
        return $this->setGroupAttributes($id, $fields);
    }
    
    public function setGroupState($id, 
        $request_array = 
        ['on'=>null,
            'bri'=>null,
            'hue'=>null,
            'sat'=>null,
            'ct'=>null,
            'xy'=>null,
            'alert'=>null,
            'effect'=>null,
            'transitiontime'=>null]){
        $request_body = [];
        foreach($request_array as $property => $value){
            if(isset($request_array[$property])){
                $request_body[$property] = $value;
            }
        }
        return $this->curlRequest("PUT", "/$id/action", $request_body);
    }
    
    public function turnOnGroup($id){
        $request_body = ['on' => true];
        return $this->curlRequest("PUT", "/$id/action", $request_body);
    }
    
    public function turnOffGroup($id){
        $request_body = ['on' => false];
        return $this->curlRequest("PUT", "/$id/action", $request_body);
    }
    
    public function deleteGroup($id){
        return $this->curlRequest("DELETE", "/$id");
    }
    
}
