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
    
    protected $tableName = "light_group";
    protected $id;
    protected $name;
    protected $on;
    protected $bri;
    protected $hue;
    protected $sat;
    protected $ct;
    protected $xy;
    protected $effect;
    protected $fields = ['id','name','on','bri','hue','sat','ct','xy','effect'];
            
    /**
     * gets lightbulb form
     * @return string HTML div
     */
    public static function getLightBulbForm(){
        Lights::verifyLights();
        //get all lightbulbs from db and create button for each
        $lightArray = (new self())->getAllRecords();
        $form = "<div><h2>Lights</h2>";
        foreach($lightArray as $lightRecord){
            $light = new self();
            $light->load_by_id($lightRecord['id']);
            $button = $light->getButtonDiv();
            $form .= "<div>$button</div>";
        }
        $party = "<button onclick='commenceParty(); '>Party Button</button>";
        $form .= "$party</div>";
        return $form . self::getAddLightDiv();
    }
    
    /**
     * 
     * @return string HTML Div of button and label
     */
    private function getButtonDiv(){    
        //add image based on status
        $source = "../images/light_bulb_on.png";
        $off_source = "../images/light_bulb_off.png";
        $onclick = "";
        $on_style = 'display:block;';
        $off_style = 'display:block;';
        
        if($this->on === '1'){
            $off_style = 'display:none;';
            $status = "off";
        }else{
            $on_style = 'display:none;';
            $status = "on";
        }
        $on_image = "<img src='$source' height = '100' width='100' id='lightbulb_on_$this->id' style='$on_style'>";
        $off_image = "<img src='$off_source' height = '100' width='100' id='lightbulb_off_$this->id' style='$off_style'>";
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-id=$this->id data-status='$status'>$this->name $on_image $off_image</div>";
        return $button;
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
        
        $groups = (new self())->getAllRecords();
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
