<?php 
$command = escapeshellcmd("python /var/www/python/lights.py");
$output = shell_exec($command);