<?php
require_once '../shell.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $group = new LightGroup($id);
    if($group->status === '0'){
        $group->status = '1';
        $lightstatus = 'on';
    }else{
        $group->status = '0';
        $lightstatus = 'off';
    }
    $group->save();
    $lightIDs = $group->getStringFromIds();
    echo "IDs: " . $lightIDs;
    $command = escapeshellcmd("python /var/www/python/lightGroup.py $lightstatus $lightIDs");
    echo "<$command br>";
    echo shell_exec($command);
}



