<?php
require_once('../shell.php');
if(isset($_POST['ID'])){
    $id = $_POST['ID'];
    $lock = new Lock($id);
    if($lock->isLocked()){
        $lock->unlock();
        $command = escapeshellcmd("python /var/www/python/clear.py");
        echo $command;
        $output = shell_exec($command);
        echo "Output: $output <br>" ;
    }else{
        $lock->lock();
        $command = escapeshellcmd("python /var/www/python/LightsHandler.py allamb on");
        echo $command;
        $output = shell_exec($command);
        echo "Output: $output <br>" ;
    }
}