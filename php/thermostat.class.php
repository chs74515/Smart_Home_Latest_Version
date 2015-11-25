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
    public $temperature;
    public $humidity;
    
    public static function getThermostatForm(){
        $thermostat = new Thermostat();
        $thermostat->updateTemperature();
        $thermostat->updateHumidity();
        return "<h2>Climate Controls</h2>" . "Current Temperature: " . round($thermostat->temperature)
            . "&deg;C<br>" . self::getThermometer(trim($thermostat->temperature)) 
            . "<br>Current Humidity: $thermostat->humidity%";
    }
    public static function getThermometer($width){
        $bulb = "<div class='bulb'></div>";
        $bar = "<div class='bar' style='width:$width%;'></div>";
        $container = "<div class='thermometer_container'>$bulb $bar<br>"
            . "<span class='therm_label'>10&deg;</span>"
            . "<span class='therm_label'>30&deg;</span>"
            . "<span class='therm_label'>60&deg;</span>"
            . "<span class='therm_label'>90&deg;</span></div>"
            . "<br><input type='range' name='temp_slide' id='temp_slide' value='$width' min='0' max='100' onchange='updateThermometer();'>"
            . "<br><div id='display_value'></div>";
        return $container;
    }
    
    public function updateTemperature(){
        $command = escapeshellcmd("sudo python /var/www/python/get_temperature.py");
        $this->temperature =  shell_exec($command);      
    }
    
    public function updateHumidity(){
        $command = escapeshellcmd("sudo python /var/www/python/humidity.py");
        $this->humidity = round(shell_exec($command));
    }
}
