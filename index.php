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
            ini_set('display_errors', '1');
            include_once("shell.php");
			include_once("php/lights.class.php");
            Authentication::processLogin();
            
            Authentication::setAuthentication(TRUE);
			
			if(!empty($_GET['page'])) {
				echo Lights::getForm();
			}
			
			if(!empty($_POST['lights'])) {
				echo Lights::processPost();
			}
			
            if(Authentication::isAuthenticated()){
                //echo page
                echo "SMART HOME <b>BALLS</b> DEEP IN";
            }else{
                echo Authentication::getForm();
            }
        ?>
    </body>
</html>