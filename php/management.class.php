<?php

class Management {
    public static function getManageMenu(){
        if(Authentication::isHomeOwner()){
            $menu = "<div><h2>Smart Home Management</h2>";
            $menu .= self::getButtonDiv("Open Network to New Devices", "scanForNewDevices");
            $menu .= self::getButtonDiv("Add User", "getAddUserMenu");
            $menu .= self::getButtonDiv("Add New Group", "getAddNewGroup");
            $menu .= self::getButtonDiv("Delete Light Group", "deleteLightGroup");
            $menu .= self::getButtonDiv("Delete A Light", "getDeleteLightForm");
            $menu .= "</div>";
        }else{
            $menu = "<div><h2 style='color:red'>Access Restricted</h2>Only the Home Owner can access this menu</div>";
        }
        return $menu;
    }
    
    protected static function getButtonDiv($label,$localMethod){
        return "<button class='nav_button' onclick=\"menuButtonHandler('" .  get_class() . "','$localMethod')\">$label</button>";
    }
    
    
    
    public static function getAddDeviceMenu(){
        $div = "";
        $div .= self::getButtonDiv("Scan For New Devices and Connect Them", "scanForNewDevices");
        $div .= self::getButtonDiv("View Result of Last Scan", "getScanResult");
        return $div;
    }
    
    public static function scanForNewDevices(){
        $seconds = 10;
        (new Config_Request())->openNetwork($seconds);
//        $countdown = "Network Open for <div id='countdown'>$seconds</div> seconds";
        sleep(10);
        $newLights = self::processNewDevices();
        if(empty($newLights)){
            return "<div>Could not find any new lights!</div>";
        }
        $div = "";
        foreach($newLights as $light){
            $div .= "<div><h3>Light Added!</h3><b>Light Name:</b>$light</div>";
        }
        return $div;
    }
    
    protected static function processNewDevices(){
        $newLights = [];
        $response = (new Lights_Request())->getAllLights();
        foreach($response as $id => $networkLight){
            if(!(new Lights())->idExistsInTable($id)){
                Lights::verifyLights();  //could be expensive
                array_push($newLights, $networkLight->name);
                LightGroup::newGroupFromLightResult($id, $networkLight);                
            }
        }
        return $newLights;
    }
    
    public static function getScanResult(){
        $devicesFound = (new Touchlink_Request())->getScanResults();
        $div = "<div>";
        if(!isset($devicesFound->result)){
            $div.= "No New Devices Found";
        }else{
            foreach($devicesFound->result as $device){
                $div .= var_export($device, TRUE);
            }
        }
        $div .= "</div>";
        return $div;
    }
    
    public static function getAddUserMenu(){
        $form = "<h3>Add a User</h3><form id='addUser' onsubmit='return false;'>";
        $form .= "<div class='userInput'><label for='username'>Username: </label><input type='text' name='username'></input></div>";
        $form .= "<div class='userInput'><label for='password'>Password: </label><input type='text' name='password'></input></div>";
        $form .= "<div class='userInput'><label for='passwordCheck'>Retype Password: </label><input type='text' name='passwordCheck'></input></div>";
        $form .= "<div class='userInput'><label for='role'>User Role: </label><select name='role'>"
            . "<option value='guest' selected>Guest</option>"
            . "<option value='owner'>Home Owner</option>"
            . "</select></div>";
        $form .= "<button onclick=\"addNewUser($(this).parent())\">Add User</button>";
        $form .= "</form>";
        return $form;
    }
    
    public static function getAddNewGroup(){
        $form = "<h3>Add a New Group</h3><form id='addGroup' onsubmit='return false;'>";
        $form .= "<div class='userInput'><label for='group_name'>Group name: </label><input type='text' name='group_name'></input></div>";
        $form .= "<button onclick=\"addNewGroup($(this).parent())\">Add New Group</button></form>";
        return $form;
        
    }
    
    
    public static function deleteLightGroup(){
        $form = "<h3>Delete a Light Group</h3><form id='deleteGroup' onsubmit='return false;'>";
        $form .= "Select a Light Group: <select class='groupSelect' name='delete_group'>";
        $lightbulbs = (new LightGroup())->getAllRecords();
        foreach($lightbulbs as $bulb){
            $form .= "<option value='".$bulb['id']."'>".$bulb['name']."</option>";
        }
        $form .= "</select><br><button onclick=\"deleteLightGroup($(this).parent())\">Delete Light Group</button>";
        return $form;
    }
    
    public static function getDeleteLightForm(){
        $form = "<h3>Delete a Light</h3><form id='deleteLight' onsubmit='return false;'>";
        $form .= "Select a Light: <select class='lightSelect' name='delete_light'>";
        $lightbulbs = (new Lights())->getAllRecords();
        foreach($lightbulbs as $bulb){
            $form .= "<option value='".$bulb['id']."'>".$bulb['name']."</option>";
        }
        $form .= "</select><br><button onclick=\"deleteLightbulb($(this).parent())\">Delete Light</button></form>";
        return $form;        
    }
    
    public static function getAllDeviceTable(){
        $state = (new DeCONZ_API())->curlRequest("GET");
        echo "Work in progress<br><br>";
        $table = "<h2>Hub State</h2><table class='state_table' border='3' cellspacing='0' cellpadding='10'>";
        //var_dump($state);
        foreach($state as $title => $property){
//            echo "<hr>";
//            var_dump($title);
            $table .= "<tr><th rowspan='".self::countChildObjects($property)."'>$title</th>";
//            echo "<br>";
//            var_dump($property);
            $table .= self::getCellsFromObject($property);
            $table .= "</tr>";
            
        }
        $table .= "</table>";
        echo $table;
    }
    
    protected static function getCellsFromObject($object){
        $totalCells = "";
        
        foreach($object as $name => $value){
            //echo "<br><br>value:";var_dump($value);
            if(is_object($value)){
                $totalCells.= "<tr><td>$name</td>" . self::getCellsFromObject($value)."</tr>";
            }else{
                if(is_array($value)){
                    $cells = "$name : ";
                    foreach($value as $item){
                        $cells .= $item . "<br>";
                    }
                    $totalCells .= "<td>$cells</td>";
                }else{
                    $totalCells .= "<td>$name : $value</td>";
                }
            }
        }
        return $totalCells;
    }
    
    protected static function countChildObjects($object){
        $count =0;
        foreach($object as $child){
            if (is_object($child)) {
                $count++;
                $count += self::countChildObjects($child);
            }
        }
        return $count;
    }
}
