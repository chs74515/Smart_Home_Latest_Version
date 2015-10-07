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
    protected $description;
    
    
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
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                //populate properties witth value
                $this->$key = $value;
//                echo "<br> [$key] => " . $this->$key;                
            }
        }else{
            echo "<h3>Appliance does not exist</h3>";
//            die();
        }
    }
    
    /**
     * return an array of applications for given type
     * @param type $type
     * @return boolean
     */
    public static function get_appliances_by_type($type){
        $select = "SELECT applianceId from appliances ";
        $where = "WHERE type = '$type';";
        $connection = self::getConnect();
        $result = mysqli_query($connection, $select . $where);
        if($result){
            while($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }else{
            return false;
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
        $sql = "UPDATE `appliances` "
            . "SET houseID = $this->houseId,"
            . " status = $this->status, "
            . "description = '$this->description', "
            . "type = '$this->type' "
            . "WHERE applianceID = $this->applianceId;";
        $result = mysqli_query($this->connect, $sql);
        echo "Result: " . $result;
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
