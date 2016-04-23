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

if(isset($_POST['username']) && isset($_POST['password'])){
    include_once('../shell.php');
    $user = new User();
    $user->username =  filter_input(INPUT_POST, "username");
    $user->passwordHash = filter_input(INPUT_POST, "password");
    $user->save();
    echo "<div style='color:green;'>User Added!</div>";
}

