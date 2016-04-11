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
            session_start();    //start $_SESSION
            Authentication::processLogin();     //process login form if submitted
            if(Authentication::isAuthenticated()){
                $nav = new Navigation_Menu();
                $nav->processControlMenu(); //process nav if submitted


                /***Add new User temp code***/
                if(isset($_GET['username'])){
                    Authentication::createNewUser();
                }
                //var_dump((new Groups_Request())->setGroupLights(1, ["1"]));
                //echo page
                //$nav->displayMenu();
            }else{
                echo Authentication::getForm();
                die();
            }
        ?>
    </body>
</html>
