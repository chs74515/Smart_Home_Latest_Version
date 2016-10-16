<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name=viewport content='width=600'>
        <title>Smartable Smart Home</title>
    </head>
    <body>
        <?php
            include_once("shell.php");
            Authentication::processLogin();     //process login form if submitted
            if(Authentication::isAuthenticated()){
                $nav = new Navigation_Menu();
                $nav->processControlMenu(); //process nav if submitted
                //echo json_encode((new Lights_Request())->getAllLights()); 
            }else{
                echo Authentication::getForm();
                die();
            }
        ?>
    </body>
</html>
