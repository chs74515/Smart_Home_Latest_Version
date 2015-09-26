<?php
require_once 'database.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Brody
 */
class User extends Database{
    private $username;
    private $id;
    private $isActivated;
    
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    /**
     * loads by id
     * please test before using
     * @param type $id
     */
    public function load_by_id($id){
        $select = "SELECT * from user ";
        $where = "WHERE id = $id limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        $row = mysqli_fetch_array($result);
        foreach($row as $key => $value){
            //populate properties witth value
            echo "$key : $value";
        }
    }
    
    public function load_by_username($user){
        $user = "brody";
        $select = "SELECT * from `smarthome`.`user` ";
        $where = "WHERE username = '$user' limit 1;";
        $query = mysqli_real_escape_string($select . $where);
        $result = mysqli_query($this->connect, $select . $where);
        //$this->getSQLError();
        //echo $select . $where;
        var_dump($result);
        if($result){
            $row = mysqli_fetch_array($result);
            foreach($row as $key => $value){
                //populate properties witth value
                echo "_ $key : $value";
            }
        }
    }
}
