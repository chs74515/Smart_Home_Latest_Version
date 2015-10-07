<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lightbulbs
 *
 * @author Brody
 */
class Lightbulb extends Appliance{
    
    public function toggle(){
        
    }
    
    public function turnOff(){
        
    }
    
    public function turnOn(){
        
    }
    
    public static function getLightBulbForm(){
        //get all lightbulbs from db and create button for each
        $lightArray = self::get_appliances_by_type('light');
        $form = "<div><h2>Lights</h2>";
        foreach($lightArray as $lightID){
            $light = new Lightbulb();
            $light->load_by_id($lightID['applianceId']);
            $button = $light->getButtonDiv();    
        $form .= "<div>$button</div>";
        }
        $party = "<button onclick='commenceParty(); '>Party Button</button>";
        $form .= "$party</div>";
        return $form;
    }
    
    private function getButtonDiv(){    
        //add image based on status
        $source = "../images/light_bulb_on.png";
        $off_source = "../images/light_bulb_off.png";
        $onclick = "toggleLight(this, '$this->applianceId', $this->status, '$this->description'); ";
        $on_style = 'display:block;';
        $off_style = 'display:block;';
        
        if($this->status === '1'){
            $off_style = 'display:none;';
        }else{
            $on_style = 'display:none;';
        }
        $on_image = "<img src='$source' height = '150' width='150' id='lightbulb_on_$this->applianceId' onclick=\"$onclick\" style='$on_style'>";
        $off_image = "<img src='$off_source' height = '100' width='100' id='lightbulb_off_$this->applianceId' onclick=\"$onclick\" style='$off_style'>";
        
        $button = "<div class='lightbulb'>$this->description $on_image $off_image</div>";
        return $button;
    }
}
