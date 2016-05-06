<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schedule
 *
 * @author Thomas Murray
 */
class Schedule extends Database{
    
    protected $tableName = "schedule";
    protected $id;
    protected $name;
    protected $description;
    protected $command;
    protected $time;
    protected $fields = ["name","description","command","time"];
    
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name=$value;
    }
    
    public static function verifySchedules(){
        $response = (new Schedules_Request())->getSchedules();
        foreach($response as $id => $det){
            self::verifySingleSchedule($id);
        }
    }
    
    public static function verifySingleSchedule($id){
        $details = (new Schedules_Request())->getScheduleAttributes($id);
        $schedule = new Schedule();
        $schedule->id = $details->id;
        $schedule->name = $details->name;
        $schedule->description = $details->description;
        foreach($details->command as $command => $value){
            if(is_array($value)){
                $schedule->$command = json_encode($value);
            }else{
                $schedule->$command = $value;
            }
        }
        $schedule->time = $details->time;
        $schedule->save();
    }
    
    public static function getSchedulingMenu(){
        $form = "<h3>Create a Schedule</h3><form id='addSchedule' onsubmit='return false;'>";
        $form .= "<div class='userInput'><label for='schedulename'>Name: </label><input type='text' name='schedulename'></input></div>";
        $form .= "<div class='userInput'><label for='scheduledescription'>Description: </label><input type='text' name='scheduledescription'></input></div>";
        $form .= "<div class='userInput'><label for='schedulecommand'>Command: </label><input type='text' name='schedulecommand'></input></div>";
        $form .= "<div class='userInput'><label for='scheduletime'>Time: <input type='text' name='scheduletime'></input></div>";
        $form .= "<button onclick=\"addNewSchedule($(this).parent())\">Add User</button>";
        $form .= "</form>";
        return $form;
    }
}
