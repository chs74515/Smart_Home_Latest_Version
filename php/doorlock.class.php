<?php

/*
 *  description
 * 
 *  @category Smart Home Project Files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

/**
 * Description of doorlock
 *
 * @author Brody
 */
class Doorlock extends Database{
    protected $tableName = "doorlock";
    protected $fields = ['id','deviceName','state'];
    public $deviceName;
    public $state;
    
    public static function synchDatabaseLocks(){
        //get locks from api
        $result = (new VDev_Lock_Request())->getAllDoorLocksRequest();
        
        //create lock objects
        foreach($result->data as $lock_result){
            $doorlock = new self();
            $doorlock->id = $lock_result->deviceId;
            $doorlock->deviceName = $lock_result->deviceName;
            $doorlock->save();//save each to database
        }        
        
    }
    
}
