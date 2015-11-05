<?php
if(isset($_POST['party'])){
    $party = $_POST['party'];
    if($party === '1'){
        $command = escapeshellcmd("python /var/www/python/sprinkles.py");
        $output = shell_exec($command);
    }else{
        $command = escapeshellcmd("python /var/www/python/killall.py");
        shell_exec($command);
        $command = escapeshellcmd("python /var/www/python/clear.py");
        shell_exec($command);
    }
}
