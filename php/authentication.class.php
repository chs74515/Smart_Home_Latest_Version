<?php

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
        $action="";
        $form="<form method=$method action=$action> $username $password $submit</form>";
        return $form;
    }
    
    private static function get_username_input(){
        $input="USERNAME: <input type='text' placeholder='username'></input>";
        return $input;
    }
    
    private static function get_password_input(){
        $input="PASSWORD: <input type='password' placeholder='password'></input>";
        return $input;
    }
    
    private static function get_submit_button(){
        $input="<input type='submit' value='Submit'></input>";
        return $input;
    }
}
