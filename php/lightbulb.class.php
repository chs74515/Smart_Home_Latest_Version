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
        $light = new Lightbulb();
        $button = $light->getButtonDiv();
        $form = "<div><h2>Lights</h2>$button</div>";
        return $form;
    }
    
    private function getButtonDiv(){    
        $button = "<div class='lightbulb'>Lightbulb</div>";
        return $button;
    }
}
