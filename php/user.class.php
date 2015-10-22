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
    private $userId;
    private $passwordHash;
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
        if($result){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                $this->$key = $value;
                //populate properties witth value
                echo "<br> [$key] => " . $this->$key;
            }
        }
    }
    
    public function load_by_username($user){
        $user = "brody";  //take out
        $select = "SELECT * from `smarthome`.`user` ";
        $where = "WHERE username = '$user' limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        //echo($select . $where);
        if($result){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                $this->$key = $value;
//               echo "<br> [$key] =>" . $this->$key ;
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function verify_password($password) {
        if(password_verify($password, $passwordHash)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    // TODO: Discuss removal with team
    public static function decodePassword($password){
        //do stuff to hash
        return $password;
    }
    
    public static function encodePassword($password){
        //hash password
        $password = password_hash($password);
        return $password;
    }
    
}
