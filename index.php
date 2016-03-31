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
        <title>Smart Home</title>
    </head>
    <body>
        <?php
            include_once("shell.php");
            session_start();    //start $_SESSION
            Authentication::processLogin();     //process login form if submitted
            if(Authentication::isAuthenticated()){
                $nav = new Navigation_Menu();
                $nav->processControlMenu(); //process nav if submitted

                /******TEST CODE*******/
                if(!empty($_GET['page'])) {
                        echo Lights::getForm();
                }

                if(!empty($_POST['lights'])) {
                        echo Lights::processPost();
                }
                /******TEST CODE******/

                /***Add new User temp code***/
                if(isset($_GET['username'])){
                    Authentication::createNewUser();
                }

                //echo page
                $nav->displayMenu();

                //var_dump(DeCONZ_API::findGateway());
                var_dump(DeCONZ_API::aquireAPIKey());
                //var_dump(Touchlink::scanForDevices());

            }else{
                echo Authentication::getForm();
                die();
            }
        ?>
    </body>
</html>
