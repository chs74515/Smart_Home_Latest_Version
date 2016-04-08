<?php

/**
 *  
 * 
 *  @category deconz api classes
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

class Schedules_Request extends DeCONZ_API{
    protected $endpoint = "/schedules";
    protected $fields = ['name','description','command','time'];
    
    public function getAllSchedules(){
        return $this->curlRequest("GET");
    }
    
    public function getScheduleAttributes($scheduleId){
        return $this->curlRequest("GET", "/$scheduleId");
    }
    
    public function createSchedule($name = null, $description = null, $command= null, $time = null){
        if(!isset($command)){
            $address = "/api$this->key/lights/1";
            $method = "GET";
            $body = "";
            $command = $this->createCommand($address, $method, $body);
        }
        if(!isset($time)){
            $time = time();
        }
        $fields = [];
        if(!isset($name)){
            $fields['name'] = $name;
        }
        if(!isset($description)){
            $fields['description'] = $description;
        }
        $fields['command'] = $command;
        $fields['time'] = $time;
        return $this->curlRequest("POST", "", $fields);
    }
    
    protected function createCommand($address, $method, $body = []){
        //may need to process parameters
        $commandBody = ['address' => $address, 'method' => $method];
        if(!empty($body)){
            $commandBody['body'] = $body;
        }
        return $commandBody;
    }
}
