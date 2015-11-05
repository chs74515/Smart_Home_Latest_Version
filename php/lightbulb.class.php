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
        $this->status = 0;
        $this->save();
    }
    
    public function turnOn(){
        $this->status = 1;
        $this->save();
    }
    
    /**
     * gets lightbulb form
     * @return string HTML div
     */
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
    
    /**
     * 
     * @return string HTML Div of button and label
     */
    private function getButtonDiv(){    
        //add image based on status
        $source = "../images/light_bulb_on.png";
        $off_source = "../images/light_bulb_off.png";
        $onclick = "toggleLight(this, '$this->applianceId', $this->status, '$this->description'); ";
        $on_style = 'display:block;';
        $off_style = 'display:block;';
        
        if($this->status === '1'){
            $off_style = 'display:none;';
            $status = "off";
        }else{
            $on_style = 'display:none;';
            $status = "on";
        }
        $on_image = "<img src='$source' height = '100' width='100' id='lightbulb_on_$this->applianceId' style='$on_style'>";
        $off_image = "<img src='$off_source' height = '100' width='100' id='lightbulb_off_$this->applianceId' style='$off_style'>";
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-id=$this->applianceId data-status='$status'>$this->description $on_image $off_image</div>";
        return $button;
    }
}
