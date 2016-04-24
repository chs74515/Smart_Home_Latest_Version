<?php
if(isset($_POST['name']) && isset($_POST['groupId'])){
    include_once('../shell.php');
    $name = filter_input(INPUT_POST,'name');
    $id = filter_input(INPUT_POST,'groupId');
    $result = (new Groups_Request())->setGroupName($id, $name);
    var_dump($result);
}


