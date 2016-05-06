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
    //private $display = TRUE;
    private static $tab_list = ['lights' => 'Lights', "management" => "Home Management", "view_all" => "View All Devices"];
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        if(isset($this->$name)){
            return $this->$name;
        }
    }
    
    public function displayMenu(){
        $tabs = "";
        foreach(self::$tab_list as $tab => $name){
            $tabs .= self::getNavButton($tab, $name) . "<br>";
        }
//        $tabs .= self::getNavButton("view_all", "View All Devices");
//        $tabs .= self::getNavButton("add_user", "Add a User");
        $method= "get";
        $action="''";
        $class="nav_menu";
        $id = "nav";
        $form="<form id=$id class=$class method=$method action=$action>$tabs</form>";
        return $form;
    }
    
    public static function getNavButton($tab_name, $title){
        $button = "<button type='submit' form='nav' name='main_tab' value='$tab_name' class='nav_button'>$title</button>";
        return $button;
    }
    
    public static function getLogoImage(){
        $img = "<img src='images/logo.png'>";
        $class = 'logo';
        $onclick = "window.location.href=\"/\";";
        $div = "<div class=$class onclick='$onclick'>$img</div>";
        return $div;
    }
    
    public function getMobileNav(){
        $class = 'mobile_nav_bar';
        $nav = "<div class=$class>".$this->getCloseButton().$this->getLogoImage().$this->displayMenu()."</div>";
        return $nav;
    }
    
    public function getCloseButton(){
        return "<div class='close_mobile_nav'>CLOSE</div>";
    }
    
    public function processControlMenu(){
        if(isset($_REQUEST['main_tab'])){
            echo $this->getMobileLink();
            echo $this->getMobileNav();
            $option = $_REQUEST['main_tab'];
            echo "<div class='content'>";
            if($option === 'lights'){
                echo LightGroup::getLightBulbForm();//need to be lightgroup form
            }else if($option == 'lightGroups'){
                echo LightGroup::getLightGroupForm();
            }else if($option == 'management'){
                echo Management::getManageMenu();
            }else if($option == 'view_all'){
                echo Management::getAllDeviceTable();
            }else{
                echo "<h3>Undefined Tab Selected</h3>";
            }
            echo "</div>";
        }else{
            //display center iwth side tabs
            echo "<div class='homepage'>";
            echo self::getCenterImage();
            echo $this->displayMenu();
            echo "</div>";
        }
        

    }
    
    public static function getCenterImage(){
        $img = "<img src='images/home2.png'>";
        $class = 'center';
        $onclick = "window.location.href=\"/\";";
        //$div = "<div class=$class onclick='$onclick'>$img</div>";
        $div = "<div class=$class>$img<div><h3>Smartable<br>Smart Home</h3></div></div>";
        return $div;
    }
    
    public static function getPopup($string){
        $div = "<div class='popup' onclick='$(\".popup\").toggle();'>$string</div>";
        return $div;
    }
    
    public static function getMobileLink(){
        return "<div class='mobileLink' id='mobileLink'><img class='menuIcon' src='../images/white_menu_icon.png'></div>";
    }
}
