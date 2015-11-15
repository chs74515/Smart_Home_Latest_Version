<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of control_menu
 *
 * @author Brody
 */
class Navigation_Menu {
    private $display = TRUE;
    private static $tab_list = ['lights' => 'Lights', 'locks' => 'Locks', 'thermostat' => 'Thermostat'];
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        if(isset($this->$name)){
            return $this->$name;
        }
    }
    
    public function displayMenu(){
        if($this->display){
            $tabs = "";
            foreach(self::$tab_list as $tab => $name){
                $tabs .= self::getNavButton($tab, $name) . "<br>";
            }
            $method= "get";
            $action="''";
            $class="nav_menu";
            $id = "nav";
            $form="<form id=$id method=$method action=$action class=$class>$tabs</form>";
            echo $form;
        }
    }
    
    public static function getNavButton($tab_name, $title){
        $button = "<button type='submit' form='nav' name='main_tab' value='$tab_name' class='nav_button'>$title</button>";
        return $button;
    }
    
    public function processControlMenu(){
        if(isset($_REQUEST['main_tab'])){
            $option = $_REQUEST['main_tab'];
            if($option === 'lights'){
                echo Lightbulb::getLightBulbForm();
            }elseif($option === 'locks'){
                echo Lock::getLockForm();
            }elseif($option === 'thermostat'){
                echo Thermostat::getThermostatForm();
            }else{
                echo "<h3>Undefined Tab Selected</h3>";
            }
            //continue with locks
            //thermostat etc.
            
            $this->display = FALSE;
        }else{
            $command = escapeshellcmd("python /var/www/python/killall.py");
            shell_exec($command);
            $command = escapeshellcmd("python /var/www/python/clear.py");
            shell_exec($command);
        }
        

    }
    
    
    
}
