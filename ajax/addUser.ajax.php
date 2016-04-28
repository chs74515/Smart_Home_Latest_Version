<?php

/* 
 *  description
 * 
 *  @category ajax files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])){
    include_once('../shell.php');
    $user = new User();
    $user->username =  filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $user->passwordHash = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $user->role = filter_input(INPUT_POST, "role");
    $user->isActivated = 1;
    $user->save();
    echo "<div style='color:green;'>User Added!</div>";
}else{
    echo "<div style='color:red;'>User Could Not Be Added!</div>";
}



