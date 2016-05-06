<?php
if(isset($_POST['lightId'])){
    require_once("../shell.php");
    $lightId = filter_input(INPUT_POST,'lightId',FILTER_SANITIZE_STRING);
    Lights::deleteLight($lightId);
    Group_Relationships::removeLightbulbRelationships($lightId);
    echo (json_encode((new Lights_Request())->deleteLight($lightId)));    
}

