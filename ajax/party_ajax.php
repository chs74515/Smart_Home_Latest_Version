<?php
if(isset($_POST['party'])){
    $party = $_POST['party'];
    if($party === '1'){
        $command = escapeshellcmd("python /var/www/python/sprinkles.py");
        $output = shell_exec($command);
    }else{
        $command = escapeshellcmd("sudo kill -9 `pidof python`");
        $output = shell_exec($command);
    }
}
