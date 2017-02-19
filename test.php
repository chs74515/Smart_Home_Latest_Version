<!DOCTYPE html>
<!--
 description

 @category Smart Home Project Files
 @author Brody Bruns <brody.bruns@hotmail.com>
 @copyright (c) 2016, Brody Bruns
 @version 1.0

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once('shell.php');
            ///*
            //echo json_encode((new Z_Way_vDev_API())->getDevices());
            echo json_encode((new VDev_Lock_Request())->getDeviceMetrics("ZWayVDev_zway_2-0-98"));
            echo "<hr>";
            echo json_encode((new VDev_Lock_Request())->closeDoorLock("ZWayVDev_zway_2-0-98"));
            echo "<hr>";
            echo json_encode((new VDev_Lock_Request())->getDeviceMetrics("ZWayVDev_zway_2-0-98"));
            //Doorlock::synchDatabaseLocks();
            ////*/
            //echo json_encode((new zDev_Device_Request("0"))->curlRequest("POST"));
            //echo json_encode((new Z_Way_zDev_API())->retrieveSystemData()); //timing out
        ?>
    </body>
</html>
