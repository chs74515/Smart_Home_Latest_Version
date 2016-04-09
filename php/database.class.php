<?php

/**
 * database class for database classes
 *
 * @category resource files
 * @author Brody Bruns <brody.bruns@hotmail.com>
 * @copyright (c) 2015, Brody Bruns
 * @version 1.0
 * 
 */

/**
 * Class to be extended by database tables
 *
 * @author Brody
 */
class Database {
    //$connect variable to make connection to database
    protected $connect;
    protected $tableName = "smarthome"; //to be overwritten
    protected $id;  //assuming everything should have an id
    protected $fields = array();
    /**
     * construct to initialize connect
     */
    public function __construct() {
        $this->connect = mysqli_connect('localhost', 'root', 'balls', $this->tableName);
        $this->getSQLError();        
    }
    
    /**
     * gets the most recent myslq error and echos it
     */
    protected function getSQLError(){
        if (mysqli_connect_errno()){
            echo "<span style = 'background-color:red;'> Failed to connect to MySQL: " . mysqli_connect_error() . "</span>";
        }
    }
    
    /**
     * method to get connect when not in object context, for static methods
     * @return mysqli $connect database connect variable
     */
    protected static function getConnect(){
        /*Enter Your connection credentials on line 43 mysqli_connect($host, $user, $password, $database, $port, $socket)*/
        $connect = mysqli_connect('localhost', 'root', 'greenman', 'gift_matcher');
        return $connect;
    }
    
    public function load_by_id($id){
        $select = "SELECT * from $this->tableName ";
        $where = "WHERE id = $id limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        if($result){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                $this->$key = $value;
                //populate properties witth value
//                echo "<br> [$key] => " . $this->$key;
            }
        }
    }
    
    /**
     * insert if not exist in db, update if id set
     */
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->insert(); //only insert from registration
        }
    }
        
    /**
     * update current record
     */
    protected function update(){
        $sql = "UPDATE `$this->tableName` SET ";
        foreach($this->fields as $field){
            $sql .= " $field = $this->$field ";
        }
        $result = mysqli_query($this->connect, $sql);
    }
    
    protected function insert(){
        $sql = "INSERT into $this->tableName SET ";
        foreach ($this->fields as $field) {
            $sql .= " $field = $this->$field ";
        }
        $result = mysqli_query($this->connect, $sql);
        if($result){
            $this->id = mysqli_insert_id($this->connect);
            $this->fields['id'] = $this->id;
        }
    }
}
