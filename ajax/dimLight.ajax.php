<?php
if(isset($_POST['groupId'])&&isset($_POST['choice'])){
    require_once('../shell.php');
    $groupID = filter_input(INPUT_POST, 'groupId');
    $dimAmount = filter_input(INPUT_POST,'choice');
    $result = (new Groups_Request())->setGroupBrightness($groupID, intval($dimAmount));
    LightGroup::verifySingleGroup($groupID);
    echo json_encode($result);
}

