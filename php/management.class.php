<?php

class Management {
    public static function getManageMenu(){
        if(Authentication::isHomeOwner()){
            $menu = "<div><h2>Smart Home Management</h2>";
            $menu .= self::getButtonDiv("Add New Devices", "getAddDeviceMenu");
            $menu .= self::getButtonDiv("Add User", "getAddUserMenu");
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
        $result = (new Touchlink_Request())->scanForDevices();
        $div = "";json_encode($result, TRUE);
        $status = "scanning";
        while($status === "scanning"){
            $devicesFound = (new Touchlink_Request())->getScanResults();
            $div .= "<br>" . json_encode($devicesFound, TRUE);
            $status = $devicesFound->scanstate;
            sleep(3);
        }
        return $div;
    }
    
    public static function getScanResult(){
        $devicesFound = (new Touchlink_Request())->getScanResults();
        $div = "<div>";
        var_dump($devicesFound);
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
    
}
