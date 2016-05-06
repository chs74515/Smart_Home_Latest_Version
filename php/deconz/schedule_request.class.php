<?php

class Schedule_Request extends DeCONZ_API{
    protected $endpoint = "/schedules";
    protected $fields = [
        "name",
        "description",
        "command",
        "time"
    ];
    
    public function createSchedule($name,$description,$groupId,$body,$time){
        $apiKey = $this->key;
        $groupId = 8;
        $body = ["on" => true];
        $command = [
            "address" => "/api/$apiKey/groups/$groupId/action", 
            "method" => "PUT",
            "body" => $body];
        $time = "2013-07-29T09:30:00";
        $fields = ['name' => $name,'description' => $description,'command' => $command,'time' => $time];
        return $this->curlRequest("POST","",$fields);
    }
    
    public function getAllSchedules(){
        return $this->curlRequest("GET");
    }
    
    public function getScheduleAttributes($id){
        return $this->curlRequest("GET", "/$id");
    }
    
    public function setScheduleAttributes($id, $fields){
        return $this->curlRequest("PUT", "/$id", $fields);
    }
    
    public function deleteSchedule($scheduleId){
        return $this->curlRequest("DELETE", "/$scheduleId");
    }
    
    public function setScheduleCommand($id, 
        $request_array = 
        ['address'=>null,
            'method'=>null,
            'body'=>null]){
        $request_body = [];
        foreach($request_array as $property => $value){
            if(isset($request_array[$property])){
                $request_body[$property] = $value;
            }
        }
        return $this->curlRequest("PUT", "/$id/command", $request_body);
    }
}
