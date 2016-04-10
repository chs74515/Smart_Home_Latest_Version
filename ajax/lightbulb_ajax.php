<?php
require_once '../shell.php';
if(isset($_POST['status'])){
    
    $id = $_POST['ID'];
    $light = new LightGroup();
    $light->load_by_id($id);
    $lightstatus = $_POST['status'];
    if($light->on === false){
        $light->on = 1;
        var_dump(new Groups_Request())->turnOnGroup($light->id);
//        $lightstatus = 'on';
    }else{
        $light->on = 0;
        var_dump((new Groups_Request())->turnOffGroup($light->id));
//        $lightstatus = 'off';
    }
    
    echo "<br>lightstatus: $lightstatus";
        
}


