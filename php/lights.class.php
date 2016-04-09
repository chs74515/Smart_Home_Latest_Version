<?php

class Lights extends Database{
    protected $device_id;
    protected $name;
    protected $tableName = "lights";
    protected $fields = ['id','name','device_id'];

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
    
    public static function verifyLights(){
        $response = (new Lights_Request())->getAllLights();
        foreach($response as $id => $lightbulb){
            $light = new self();
            $light->id = $id;
            $light->name = $lightbulb->name;
            $light->device_id = $lightbulb->uniqueid;
            $light->save();
        }
    }
        
    /**
     * gets lightbulb form
     * @return string HTML div
     */
    public static function getLightBulbForm(){
        self::verifyLights();
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
        $onclick = "";
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
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-id=$this->id data-status='$status'>$this->name $on_image $off_image</div>";
        return $button;
    }
}