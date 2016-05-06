<?php

class Lights extends Database{
    protected $device_id;
    protected $name;
    protected $reachable;
    protected $hascolor;
    protected $tableName = "lights";
    protected $fields = ['id','name','device_id','reachable','hascolor'];

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
            if($lightbulb->state->reachable){
                $light->reachable = 1;
            }else{
                $light->reachable = 0;
            }
            if( $lightbulb->hascolor){
                $light->hascolor = 1;
            }else{
                $light->hascolor = 0;
            }
            $light->save();
        }
    }
    
    public static function getUnreachableNotice(){
        $light_results = (new self())->getAllRecords();
        $div_group = "";
        foreach($light_results as $result){
            if(!$result['reachable']){
                $div_group .= "<div id='unreachable_".$result['id']."'>"
                    . " <h3>" . $result['name'] . " Cannot be reached</h3>It may be turned "
                    . "off or no longer connected, please turn it back on or remove it using the management tab.<div class='close' "
                    . "onclick=\"$('#unreachable_".$result['id']."').toggle();\">x</div></div>";
            }
        }
        return $div_group;
    }
    
    public static function deleteLight($lightId){
         $sql = "DELETE FROM lights WHERE id = $lightId;";
         echo $sql;
        $result = mysqli_query(Database::getConnect(), $sql);
        return $result;
    }
}