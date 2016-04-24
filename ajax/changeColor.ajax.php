<?php
if(isset($_POST['color'])){
    include_once('../shell.php');  
    $color = filter_input(INPUT_POST, 'color');
    echo $color; //how to convert this to hue?
    
}


