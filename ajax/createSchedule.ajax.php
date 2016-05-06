<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_POST['schedulecommand'])){
    include_once('../shell.php');
    $schedulename = filter_input(INPUT_POST, "schedulename", FILTER_SANITIZE_STRING);
    $scheduledescription = filter_input(INPUT_POST, "scheduledescription", FILTER_SANITIZE_STRING);
    $schedulecommand = filter_input(INPUT_POST, "schedulecommand", FILTER_SANITIZE_STRING);
    $scheduletime = filter_input(INPUT_POST, "scheduletime", FILTER_SANITIZE_STRING);
    $request = new Schedule_Request();
    $result = $request->createSchedule($schedulename,$scheduledescription,NULL,$schedulecommand,$scheduletime);
    
    var_dump($result);
    $schedule = new Schedule();
    $schedule->name = $schedulename;
    $schedule->description = $scheduledescription;
    $schedule->command = $schedulecommand;
    $schedule->time = $scheduletime;
    $schedule->save();
    
    echo "<div style='color:green;'>Schedule Added!</div>";
}else{
    echo "<div style='color:red;'>Schedule Could Not Be Added!</div>";
}
