<?php
var_dump($_POST);
if(isset($_POST['groupId']) && isset($_POST['status']) && isset($_POST['lightId'])){
    require_once('../shell.php');
    $groupId = filter_input(INPUT_POST, 'groupId',FILTER_SANITIZE_STRING);    
    $status = filter_input(INPUT_POST, 'status',FILTER_SANITIZE_STRING);
    $lightId = filter_input(INPUT_POST, 'lightId',FILTER_SANITIZE_STRING);
    $lightIds = Group_Relationships::getAllRelationships($groupId);
    $lights = [];
    if($status === 'in group'){  //toggle out of group
        foreach($lightIds as $light){
            if($light === $lightId){
                continue;
            }else{
                array_push($lights, $light);
            }
        }
        $result = (new Groups_Request())->setGroupLights($groupId, $lights);
        var_dump($result);
        //remove light relationship
        Group_Relationships::removeRelationship($groupId, $lightId);
    }else{ //toggle into group
        array_push($lightIds, $lightId);
        $result = (new Groups_Request())->setGroupLights($groupId, $lightIds);
        var_dump($result);
        //add light relationship
        Group_Relationships::addRelationship($groupId, $lightId);
    }
}
