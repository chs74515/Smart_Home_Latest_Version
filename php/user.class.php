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
//                echo "<br> [$key] => " . $this->$key;
            }
        }
    }
    
    public function load_by_username($user){
        $select = "SELECT * from `smarthome`.`user` ";
        $where = "WHERE username = '$user' limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        //echo($select . $where);
        if(mysqli_num_rows($result) > 0){
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
        if($this->passwordHash === self::encodePassword($password)) {  //weak to timing attacks
            return true;
        } else {
            return false;
        }
        
    }
    
    public static function encodePassword($password){
        $encrypted = crypt($password, '$2y$12$' . sha1($password) . '$');
        //hash password
        //$password = password_hash($password, PASSWORD_DEFAULT); not compatible with 5.4
        return $encrypted; //return just crypted password
    }
    
    /**
     * insert if not exist in db, update if id set
     */
    public function save(){
        if($this->userId){
            $this->update();
        }else{
            $this->insert(); //only insert from registration
        }
    }
    
    /**
     * update current record
     */
    private function update(){
        $sql = "UPDATE `user` SET "
            . "username = '$this->username', "
            . "passwordHash = '$this->passwordHash', "
            . "isActivated = $this->isActivated "
            . "WHERE userID = $this->userId; ";
        $result = mysqli_query($this->connect, $sql);
    }
    
    /**
     * insert record into DB
     */
    private function insert(){
        $user = mysqli_real_escape_string($this->connect, $this->username);
        $pass = self::encodePassword($this->passwordHash);
        $sql = "INSERT into user (username, passwordHash) "
            . "VALUES ('$user', '$pass'); ";
        $result = mysqli_query($this->connect, $sql);
        if($result){
            $this->userId = mysqli_insert_id($this->connect);
        }
    }
    
    //should we just return hash, or has salt pair?
    private function seperateHashSalt($passHash){
        preg_replace('/^' . preg_quote(self::$salt, '/') . '/', '', $passHash);
        return $passHash;
    }
}
