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
    protected $fields = ['name','description','command','time'];
    
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
    
    public static function displaySchedules(){
        $state = (new Schedule_Request())->getScheduleAttributes(1);
        $table = "<h2>Schedules Data</h2><table>";
        var_dump($state);
        foreach($state as $title => $property){
            var_dump($title);
            $table .= "<tr><th>$title</th>";
            if(is_object($property)){
                $table .= self::getCellsFromObject($property);
            }else{
                $table .= "<td>$property</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        echo $table;
    }
    
    protected static function getCellsFromObject($object){
        //$cells = "";
        foreach($object as $name => $value){
            echo "<br>value:";var_dump($value);
            if(is_object($value)){
                return "<td>$name</td>" . self::getCellsFromObject($value);
            }else{
                if(is_array($value)){
                    $cells = "";
                    foreach($value as $item){
                        $cells .= $item . "<br>";
                    }
                    return "<td>$cells</td>";
                }else{
                    return "<td>$name</td><td>$value</td>";
                }
            }
        }
    }
    
    public static function getScheduleMenu(){
        if(Authentication::isHomeOwner()){
            $menu = "<div><h2>Smart Home Scheduling</h2>";
            $menu .= self::getButtonDiv("View Schedule", "viewSchedule");
            $menu .= self::getButtonDiv("Create Schedule", "createScheduleForm");
            $menu .= self::getButtonDiv("Edit Schedule", "editScheduleForm");
            $menu .= "</div>";
        }else{
            $menu = "<div><h2 style='color:red'>Access Restricted</h2>Only the Home Owner can access this menu</div>";
        }
        return $menu;
    }    
    
    protected static function getButtonDiv($label,$localMethod){
        return "<button class='nav_button' onclick=\"menuButtonHandler('" .  get_class() . "','$localMethod')\">$label</button>";
    }
    
    public static function viewSchedule(){
        $form = self::displaySchedules();
        return $form;
    }
    
    // Adds schedule to database and pi
    public static function createScheduleForm(){
        $form = "<h3>Create Schedule</h3><form id='addSchedule' onsubmit='return false;'>";
        $form .= "<div class='userInput'><label for='schedulename'>Name: </label><input type='text' name='schedulename'></input></div>";
        $form .= "<div class='userInput'><label for='scheduledescription'>Description: </label><input type='text' name='scheduledescription'></input></div>";
        $form .= "<div class='userInput'><label for='schedulecommand'>Command: </label><input type='text' name='schedulecommand'></input></div>";
        $form .= "<div class='userInput'><label for='scheduletime'>Time: <input type='text' name='scheduletime'></input></div>";
        $form .= "<button onclick=\"addNewSchedule($(this).parent())\">Create Schedule</button>";
        $form .= "</form>";
        return $form;
    }
    
    // Doesn't do anything currently
    public static function editScheduleForm(){
        $form = "<h3>Edit Schedule</h3><form id='addSchedule' onsubmit='return false;'>";
        $form .= "<div class='userInput'><label for='schedulename'>Name: </label><input type='text' name='schedulename'></input></div>";
        $form .= "<div class='userInput'><label for='scheduledescription'>Description: </label><input type='text' name='scheduledescription'></input></div>";
        $form .= "<div class='userInput'><label for='schedulecommand'>Command: </label><input type='text' name='schedulecommand'></input></div>";
        $form .= "<div class='userInput'><label for='scheduletime'>Time: <input type='text' name='scheduletime'></input></div>";
        $form .= "<button onclick=\"addNewSchedule($(this).parent())\">Edit Schedule</button>";
        $form .= "</form>";
        return $form;
    }    
    
    /**
     * insert if not exist in db, update if id set
     */
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->insert(); //only insert from registration
        }
    }
    
    /**
     * update current record
     */
    protected function update(){
        $sql = "UPDATE `schedule` SET "
            . "name = '$this->name', "
            . "description = '$this->description', "
            . "command = $this->command, "
            . "time = '$this->time'"
            . "WHERE iD = $this->id; ";
        $result = mysqli_query($this->connect, $sql);
    }
    
    /**
     * insert record into DB
     */
    protected function insert(){
        $user = mysqli_real_escape_string($this->connect, $this->name);
        $description = mysqli_real_escape_string($this->connect, $this->description);
        $command = mysqli_real_escape_string($this->connect, $this->command);
        $time = mysqli_real_escape_string($this->connect, $this->time);
        $sql = "INSERT into schedule (name, description, command, time) "
            . "VALUES ('$user', '$description', '$command', '$time'); ";
        $result = mysqli_query($this->connect, $sql);
        if($result){
            $this->id = mysqli_insert_id($this->connect);
        }
    }
}
