<?php
require_once '../shell.php';
if(isset($_POST['status'])){
    $status = $_POST['status'];
    $id = $_POST['ID'];
    echo $status;
    $light = new Lightbulb();
    $light->load_by_id($id);
    
    if($status === '0'){
        $light->status = '1';
    }else{
        $light->status = '0';
    }
    $light->save();
    
}


