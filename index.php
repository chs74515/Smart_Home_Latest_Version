<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Home</title>
    </head>
    <body>
        <?php
            include_once("shell.php");
            session_start();
            Authentication::processLogin();
            
            if(!Authentication::isAuthenticated()){
                Authentication::setAuthentication(TRUE); //take out to sue authentication
                echo "<script>welcomeMsg();</script>";
            }

            /******TEST CODE*******/
            if(!empty($_GET['page'])) {
                    echo Lights::getForm();
            }

            if(!empty($_POST['lights'])) {
                    echo Lights::processPost();
            }
            /******TEST CODE******/
            
            if(Authentication::isAuthenticated()){
                //echo page
                echo "SMART HOME <b>BALLS</b> DEEP IN";
                echo Lightbulb::getLightBulbForm();
            }else{
                echo Authentication::getForm();
            }
        ?>
    </body>
</html>