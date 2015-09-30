<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of appliance
 *
 * @author Brody
 */
class Appliance extends Database{
    protected $applianceId;
    protected $houseId;
    protected $status;
    protected $type;
    
    
    public function __construct($id = null) {
        parent::__construct();
        if($id){
            $this->load_by_id($id);
        }
    }
    
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    public function load_by_id($id){
        $select = "SELECT * from appliances ";
        $where = "WHERE applianceId = $id limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        $row = mysqli_fetch_array($result);
        if($result){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                //populate properties witth value
                echo "<br> [$key] => " . $this->$key;
                $this->$key = $value;
            }
        }
    }
    
    public function save(){
        if($this->applianceId){
            $this->update();
        }else{
            $this->insert();
        }
    }
    
    private function update(){
        
    }
    
    private function insert(){
        $sql = "INSERT into `appliances` (`houseID`, `status`, `type`) "
            . "VALUES ($this->houseId, $this->status, $this->type); ";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result);
        foreach($row as $key=>$value){
            echo "<br>$key => [$value]";
        }
    }
}
