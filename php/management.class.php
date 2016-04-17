<?php

class Management {
    public static function getManageMenu(){
        $menu = "<div><h2>Smart Home Management</h2>";
        $menu .= self::getButtonDiv("Add New Devices", "getAddDeviceMenu");
        $menu .= "</div>";
        return $menu;
    }
    
    protected static function getButtonDiv($label,$localMethod){
        return "<button class='nav_button' onclick=\"menuButtonHandler('" .  get_class() . "','$localMethod')\">$label</button>";
    }
    
    public static function getAddDeviceMenu(){
        return "Add device";
    }
}
