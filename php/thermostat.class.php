<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of thermostat
 *
 * @author Brody
 */
class Thermostat {
    public static function getThermostatForm(){
        
        return "<h2>Climate Controls</h2>" . self::getThermometer();
    }
    public static function getThermometer(){
        $width = '300px';
        $bulb = "<div class='bulb'></div>";
        $bar = "<div class='bar' style='width:$width;'></div>";
        $container = "<div class='thermometer_container'>$bulb $bar<br>"
            . "<span class='therm_label'>10&deg;</span>"
            . "<span class='therm_label'>30&deg;</span>"
            . "<span class='therm_label'>60&deg;</span>"
            . "<span class='therm_label'>90&deg;</span></div>";
        return $container;
    }
}
