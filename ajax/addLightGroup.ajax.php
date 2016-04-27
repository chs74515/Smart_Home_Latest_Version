<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['name'])){
    include_once('../shell.php');
    $group = filter_input(INPUT_POST, "name");
    $result = (new Groups_Request());
    $result->createGroup($group);
    
    echo "<div style='color:green;'>Light Group Added!</div>";
}else{
    echo "<div style='color:red;'>Light Group Could Not Be Added!</div>";
}
