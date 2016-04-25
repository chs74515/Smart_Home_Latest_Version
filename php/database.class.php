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
    protected $db_name = "smarthome";
    protected $tableName; //to be overwritten
    protected $id;  //assuming everything should have an id
    protected $fields = array();
    /**
     * construct to initialize connect
     */
    public function __construct() {
        $this->connect = mysqli_connect('localhost', 'root', 'balls', $this->db_name);
        $this->getSQLError();        
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
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
        $database = new self();
        $connect = mysqli_connect('localhost', 'root', 'balls', $database->db_name);
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
    
    public function load_by_field($field, $value, $operator = '=', $limit=1){
        $select = "SELECT * from $this->tableName ";
        $where = "WHERE $field $operator $value limit $limit;";
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
    
    public function load_by_fields($fields = [['name'=>'','value'=>'','operator'=>'=']],$limit = 1){
        $select = "SELECT * from $this->tableName ";
        $where = "WHERE ";
        $clause = [];
        foreach($fields as $field){
            array_push($clause, $field['name'] ." " . $field['operator'] . " " . $field['value']);
        }
        $where .= implode(" and ", $clause);
        $where .= " limit $limit;";
        $result = mysqli_query($this->connect, $select . $where);
        if($result){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $values){
                $this->$key = $values;
                //populate properties witth value
//                echo "<br> [$key] => " . $this->$key;
            }
        }
    }
    
    public function load_by_all_fields($limit = 1){
        $select = "SELECT * from $this->tableName ";
        $where = "WHERE ";
        $clause = [];
        foreach($this->fields as $field){
            if(isset($this->$field)){
                array_push($clause, $field ." = " . $this->$field);
            }
        }
        $where .= implode(" and ", $clause);
        $where .= " limit $limit;";
        $result = mysqli_query($this->connect, $select . $where);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $values){
                $this->$key = $values;
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
            if($this->idExistsInTable($this->id)){
                $this->update();
            }else{
                $this->insert();
            }
        }else{
            $this->insert(); //only insert from registration
        }
    }
      
    public function idExistsInTable($id){
        $select = "SELECT * from $this->tableName where id = $id";
        $result = mysqli_query($this->connect, $select);
        if($result){
            return ($result->num_rows > 0);
        } //what if error?
    }
    
    /**
     * update current record
     */
    protected function update(){
        $sql = "UPDATE `$this->tableName` SET ";
        $fieldTypes = $this->fetchFieldTypes();
        $values = [];
        foreach ($this->fields as $field) {
            if($fieldTypes[$field] >= 252 && $fieldTypes[$field] <= 254){
                $value = "'".$this->$field."'";
            }else{
                $value = $this->$field;
            }
            array_push($values, " `$field` = $value ");
        }
        $sql .= " " . implode(", ", $values) . ";";
        $result = mysqli_query($this->connect, $sql);
    }
    
    protected function insert(){
        $sql = "INSERT into $this->tableName SET ";
        $fieldTypes = $this->fetchFieldTypes();
        $values = [];
        foreach ($this->fields as $field) {
            if($fieldTypes[$field] >= 252 && $fieldTypes[$field] <= 254){
                $value = "'".$this->$field."'";
            }else{
                $value = $this->$field;
            }
            array_push($values, " `$field` = $value ");
        }
        $sql .= " " . implode(", ", $values) . ";";
        $result = mysqli_query($this->connect, $sql);
        if($result){
            $this->id = mysqli_insert_id($this->connect);
            $this->fields['id'] = $this->id;
        }
    }
    
    public function getAllRecords(){
        $rows = array();
        $select = "SELECT * from $this->tableName ";
        $result = mysqli_query($this->connect, $select);
        if($result){
            while($row = mysqli_fetch_assoc($result)) {
                array_push($rows, $row);
            }
        }
        return $rows;
    }
    
    public function fetchFieldTypes(){
        $select = "SELECT * from $this->tableName LIMIT 1;";
        $result = mysqli_query($this->connect, $select);
        $fieldInfo = mysqli_fetch_fields($result);
        $fieldTypes = [];
        foreach($fieldInfo as $field){
            $fieldTypes["$field->name"] = $field->type;
        }
        //return array fieldname => type
        return $fieldTypes;
    }
    
}
