<?php

/**
 *  description
 * 
 *  @category database files
 *  @author Brody Bruns <brody.bruns@hotmail.com>
 *  @copyright (c) 2016, Brody Bruns
 *  @version 1.0
 * 
 */

class Group_Relationships extends Database{
    protected $tableName= "group_relationships";
    protected $fields = ['id','lightId','groupId'];
    protected $lightId;
    protected $groupId;
    
    public function __construct($light_id, $group_id) {
        parent::__construct();
        $this->lightId = $light_id;
        $this->groupId = $group_id;
        $this->load_by_all_fields(); //in case already in db
    }
    
    public static function getAllRelationships($groupId){
        if(!isset($groupId)){
            return [];//if array empty, dont go any further
        }
        $sql = "SELECT lightId from group_relationships WHERE groupId = $groupId;";
        $result = mysqli_query(Database::getConnect(), $sql);
        $lightIds = [];
        if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)){
                array_push($lightIds, $row['lightId']);
            }
        }
        return $lightIds;
    }
    
    public static function removeRelationship($groupId, $lightId){
        $sql = "DELETE FROM group_relationships WHERE groupId = $groupId AND lightId = $lightId;";
        $result = mysqli_query(Database::getConnect(), $sql);
        return $result;
    }
    
    public static function removeGroupRelationship($groupId){
        $sql = "DELETE FROM group_relationships WHERE groupId = $groupId;";
        $result = mysqli_query(Database::getConnect(), $sql);
        return $result;
    }
        
    public static function removeLightbulbRelationships($lightId){
        $sql = "DELETE FROM group_relationships WHERE lightId = $lightId;";
        $result = mysqli_query(Database::getConnect(), $sql);
        return $result;
    }
    
    public static function addRelationship($groupId, $lightId){
        $relationship = new self($lightId, $groupId);
        $result = $relationship->save();
        //var_dump($relationship);
        return $result;
    }
}
