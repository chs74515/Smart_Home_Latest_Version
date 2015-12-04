<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lightGroup
 *
 * @author Brody
 */
class LightGroup extends Database{
    
    private $id;
    private $name;
    private $appliance_ids;  //light ids on sense hat
    private $lightIds = array();
    private $status;
    
    public function __construct($id) {
        parent::__construct();
        $this->id = $id;
        $this->load_by_id($id);
        $this->lightIds = explode(" ", $this->appliance_ids);
    }
    
    
    public function __get($name){
        return $this->$name;
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
        echo "$name => $value";
    }
    
    public function load_by_id($id){
        $select = "SELECT * from light_group ";
        $where = "WHERE id = $id limit 1;";
        $result = mysqli_query($this->connect, $select . $where);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            foreach($row as $key => $value){
                //populate properties witth value
                $this->$key = $value;
//                echo "<br> [$key] => " . $this->$key;                
            }
        }else{
            echo "<h3>Group does not exist</h3>";
//            die();
        }
    }
    
    public function turnOff(){
        $this->status = 0;
        $this->save();
    }
    
    public function turnOn(){
        $this->status = 1;
        $this->save();
    }
    
    public function isOn(){
        return ($this->status === '1');
    }
    
    public function save(){
        if($this->id){
            $this->update();
        }else{
            $this->insert();
        }
    } 
    
    private function update(){
        $sql = "UPDATE `light_group` "
            . "SET name = '$this->name',"
            . " appliance_ids = '$this->appliance_ids', "
            . "status = $this->status "
            . "WHERE id = $this->id;";
        mysqli_query($this->connect, $sql);
        
    }
    
    private function insert(){
        $sql = "INSERT into `light_group` (`name`, `appliance_ids`, `status`) "
            . "VALUES ($this->name, $this->appliance_ids, $this->status); ";
        $result = mysqli_query($this->connect, $sql);
        $row = mysqli_fetch_array($result);
        foreach($row as $key=>$value){
            echo "<br>$key => [$value]";
        }
    }
    
    /**
     * gets lightbulb form
     * @return string HTML div
     */
    public static function getLightGroupForm(){
        self::processAddLight();
        //get all lightbulbs from db and create button for each
        $lightArray = self::getAllGroupIds();
        $form = "<div><h2>Light Groups</h2>";
        foreach($lightArray as $groupId){
            $light = new LightGroup($groupId);
            $button = $light->getButtonDiv();
            $form .= "<div>$button</div>";
            //$light->activateLight();
        }
        $form .= "</div>" . self::getAddLightDiv();
        return $form;
    }
    
    /**
     * 
     * @return string HTML Div of button and label
     */
    private function getButtonDiv(){  
        //add image based on status
        $source = "../images/light_bulb_on.png";
        $off_source = "../images/light_bulb_off.png";
        $onclick = "toggleLightGroup(this); ";
        $on_style = 'display:block;';
        $off_style = 'display:block;';
        
        if($this->status === '1'){
            $off_style = 'display:none;';
            $status = "off";
        }else{
            $on_style = 'display:none;';
            $status = "on";
        }
        $on_image = "<img src='$source' height = '100' width='100' id='lightbulb_on_$this->id' style='$on_style'>";
        $off_image = "<img src='$off_source' height = '100' width='100' id='lightbulb_off_$this->id' style='$off_style'>";
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-group_id='$this->id'>$this->name $on_image $off_image</div>";
        $this->activateLights();
        return $button;
    }
    
    public function activateLights(){
        if($this->isOn()){
            //causes slowdown
            $command = escapeshellcmd("python /var/www/python/lightGroup.py on $this->appliance_ids ");
        shell_exec($command);
        }        
    }
    
    public function addIdToApplianceIds($id){
        $this->appliance_ids .= " " . $id;
    }
    
    /**
     * 
     * @return array of names in db
     */
    public static function getAllGroupIds(){
        $sql = "SELECT id FROM light_group;";
        $connection = self::getConnect();
        $result = mysqli_query($connection, $sql);
        $rows = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)) {
                array_push($rows, $row['id']);
            }
            return $rows;
        }else{
            return false;
        }
    }
        
    public function getStringFromIds(){
        $string = "";
        foreach($this->lightIds as $id){
            $string .= " " . $id;
        }
        return $string;
    }
    
    public static function getAddLightDiv(){
        $div = "<div id='add_light' onclick='$(\"#add_form\").toggle();'>+</div>";
        $form = "<form id='add_form' action='?main_tab=lightGroups' method='post'>"
            . "<b>Add to Group</b><hr>LightId: "
            . "<select name='lightID'>";
        for($i=0; $i<64; $i++){
            $form .= "<option value=$i>$i</option>";
        }
        $form .= "</select>"
            . "<br>Group Name: "
            . "<select name='groupID'>";
        
        $groups = self::getAllGroupIds();
        foreach($groups as $groupID){
            $group = new LightGroup($groupID);
            $form .= "<option value='$group->id'>$group->name</option>";
        }
        $form .= "</select>"
            . "<br><input type='submit' name='addLight' value='submit'></input>"
            . "</form>";
        return $div . $form;
    }
    
    //method to process add light
    public static function processAddLight(){
        if(isset($_POST['addLight'])){
            
            //get group from passed id
            $groupID = $_POST['groupID'];
            $lightID = $_POST['lightID'];
            $group = new LightGroup($groupID);
            $group->addIdToApplianceIds($lightID);
            $group->save();
            echo Navigation_Menu::getPopup("Your Light has been added!");
        }
    }
    
    
}
