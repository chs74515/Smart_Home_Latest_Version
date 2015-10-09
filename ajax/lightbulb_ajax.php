<?php
require_once '../shell.php';
if(isset($_POST['status'])){
    
    $id = $_POST['ID'];
    $light = new Lightbulb();
    $light->load_by_id($id);
    $lightid = 1;
    $lightstatus = $_POST['status'];
//    if($light->status === '0'){
//        $light->status = '1';
//        $lightstatus = 'on';
//    }else{
//        $light->status = '0';
//        $lightstatus = 'off';
//    }
    echo "<br>lightstatus: $lightstatus";
    $light->save();
    $command = escapeshellcmd("python /var/www/python/LightsHandler.py $id $lightstatus");
    echo $command;
    $output = shell_exec($command);
    echo "Output: $output <br>" ;
    
}


