<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['name'])){
    include_once('../shell.php');
    $group_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    Group_Relationships::removeGroupRelationship($group_name);
    $request = new Groups_Request();
    $request->deleteGroup($group_name);
    LightGroup::deleteGroupFromDb($group_name);
    
    echo "<div style='color:green;'>Light Group Deleted!</div>";
}else{
    echo "<div style='color:red;'>Light Group Could Not Be Deleted!</div>";
}
