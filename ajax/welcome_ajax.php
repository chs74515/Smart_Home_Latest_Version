<?php 
if(isset($_POST['name'])){
    $username = $_POST['name'];
    $command = escapeshellcmd("python /var/www/python/lights.py $username");
    shell_exec($command);
}