<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lock
 *
 * @author Brody
 */
class Lock extends Appliance{
    private $lock_img = "&#x1f512;";
    private $unlock_img = "&#x1f513;";
    private $name;
    private $handler;
    
    public function __construct($id = null) {
        parent::__construct($id);
        $details = explode(",", $this->description);
        $this->name = $details[0];
        $this->handler = $details[1];
        if(isset($details[2])){
            $this->lock_img = $details[2];
        }
        if(isset($details[3])){
            $this->unlock_img = $details[3];
        }
    }
    
    public function toggle(){
        if($this->isLocked()){
            $this->unlock();
        }else{
            $this->lock();
        }
    }
    
    public function lock(){
        $this->status = 0;
        $this->save();
    }
    
    public function unlock(){
        $this->status = 1;
        $this->save();
    }
    
    public function isLocked(){
        return ($this->status === '0');
    }
    
    public function isUnlocked(){
        return ($this->status === '1');
    }
    
    /**
     * gets lightbulb form
     * @return string HTML div
     */
    public static function getLockForm(){
        //get all lightbulbs from db and create button for each
        $lockArray = self::get_appliances_by_type('lock');
        $form = "<div><h2>Locks</h2>";
        foreach($lockArray as $lockItem){
            $lock = new Lock($lockItem['applianceId']);
            $onclick = "toggleLock(this); ";
            $button = $lock->getButtonDiv($onclick);    
            $form .= "<div>$button</div>";
        }

        $form .= "</div>";
        return $form;
    }
    
    private function getButtonDiv($onclick){
        
        $locked_style = 'display:block;';
        $unlocked_style = 'display:block;';
        
        if($this->isLocked()){
            $unlocked_style = 'display:none;';
        }else{
            $locked_style = 'display:none;';
        }
        $locked_image = "<div class='button_img' id='locked_$this->applianceId' style='$locked_style'>$this->lock_img</div>";
        $unlocked_image = "<div class='button_img' id='unlocked_$this->applianceId' style='$unlocked_style'>$this->unlock_img</div>";
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-id=$this->applianceId data-handler=$this->handler>$this->name $locked_image $unlocked_image</div>";
        return $button;
    }
}
