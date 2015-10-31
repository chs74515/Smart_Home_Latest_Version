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
        if(isset($_REQUEST['submit'])){     //check for submission
            $user = new User();
            $username=$_REQUEST['username'];
            $password=$_REQUEST['password'];
            $loaded = $user->load_by_username($username);
            if($loaded){
                if($user->verify_password($password)) {
                    Authentication::setAuthentication(True);
                    //display welcome
                    echo "<script>welcomeMsg();</script>";
                } else {
                    echo("<h4 style='color:red;'>Invalid password</h4>");
                }
                //continue processing
            }else{
                //handling for wrong username, allow registration
                echo("<h4 style='color:red;'>Invalid username</h4>");
            }
            
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
