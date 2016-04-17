<?php
if(isset($_POST['className']) && isset($_POST['methodName'])){
    require_once '../shell.php';
    $class = filter_input(INPUT_POST, 'className');
    $method = filter_input(INPUT_POST, 'methodName');
    if(method_exists($class, $method)){
        echo call_user_func("$class::$method");
    }
}

