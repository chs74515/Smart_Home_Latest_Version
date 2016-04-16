<?php

class Lights extends Database{
    protected $device_id;
    protected $name;
    protected $tableName = "lights";
    protected $fields = ['id','name','device_id'];

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
    
    public static function verifyLights(){
        $response = (new Lights_Request())->getAllLights();
        foreach($response as $id => $lightbulb){
            $light = new self();
            $light->id = $id;
            $light->name = $lightbulb->name;
            $light->device_id = $lightbulb->uniqueid;
            $light->save();
        }
    }
}