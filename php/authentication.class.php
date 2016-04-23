<?php
require_once 'user.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authentication
 *
 * @author Brody
 */
class Authentication {
    public static function getForm(){
        $username=  self::get_username_input();
        $password= self::get_password_input();
        $submit= self::get_submit_button();
        $method= "post";
        $action="''";
        $class="login_form"; 
        $form="<form method=$method action=$action class=$class> $username <br> $password <br> $submit</form>";
        return $form;
    }
    
    private static function get_username_input(){
        $input="USERNAME: <input type='text' placeholder='username' name='username'></input>";
        return $input;
    }
    
    private static function get_password_input(){
        $input="PASSWORD: <input type='password' placeholder='password' name='password'></input>";
        return $input;
    }
    
    private static function get_submit_button(){
        $input="<input type='submit' value='Submit' name='submit'></input>";
        return $input;
    }
    
    //process login form
    public static function processLogin(){
        if(isset($_POST['submit'])){     //check for submission
            $user = new User();
            $username=  filter_input(INPUT_POST, 'username');
            $password= filter_input(INPUT_POST, 'password');
            $loaded = $user->load_by_username($username);
            if($loaded){
                if($user->verify_password($password)) {
                    if($user->isActivated === '1'){
                        Authentication::setAuthentication(True);
                        self::performLoginActions($user->username);
                    }else{
                        echo "<span style='color:red;'>Your Account has not yet been activated, please contact your system administrator</span>";
                    }                    
                } else {
                    //password may not have been hashed yet
                    $user->passwordHash = User::encodePassword($user->passwordHash);
                    if($user->verify_password($password)){                        
                        $user->save();
                        Authentication::setAuthentication(TRUE);
                        self::performLoginActions($user->username);
                    }else{
                        //if here, password is wrong
                        echo("<h4 style='color:red;'>Invalid password</h4>");
                        sleep(.05);  //to partially counter brute force
                    }
                }
                //continue processing
            }else{
                //handling for wrong username, allow registration
                echo("<h4 style='color:red;'>Invalid username</h4>");
            }
            
        }
    }
    
    public static function performLoginActions($username){
        //echo "<div class='audio'><audio autoplay controls><source src='images/ballsDeep.mp3' type='audio/mpeg'></audio></div>";
    }
    
    public static function createNewUser(){
        echo "Creating new user account for ". $_GET['username'] .
            "<br>You will need to contact your system admin to activate this account";
        if(isset($_GET['username']) && isset($_GET['password'])){
            $user = new User();
            $user->username = $_GET['username'];
            $user->passwordHash = ($_GET['password']);
            $user->save();
        }
    }
    
    /**
     * 
     * @return boolean true if authenticated flagged in session
     */
    public static function isAuthenticated(){
        if(!isset($_SESSION['authenticated'])){
            $_SESSION['authenticated'] = FALSE;
        }
        return $_SESSION['authenticated'];
    }
    
    public static function setAuthentication($value){
        $_SESSION['authenticated'] = $value;
    }
}
