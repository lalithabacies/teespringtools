<?php

namespace app\models;

use Yii;
use app\models\AppList;

/**
 * This is the model class for table "tshirt_access".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $appid
 * @property integer $status
 * @property string $created_date
 * @property integer $role_id
 */
class TshirtAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'appid', 'status'], 'required'],
            [['userid', 'appid', 'status', 'role_id'], 'integer'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'appid' => 'Appid',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'role_id' => 'Role ID',
        ];
    }
	
	
	/**
     * @returns the role id
     */
	public function getCustomRoleAccess($params)
	{			
		$sql = "select a.role_id from tshirt_access a join roles r on a.role_id=r.id where r.rolename='customRole' and a.userid=:userid;";
		$rawData = Yii::$app->db->createCommand($sql);
		$rawData->bindParam(":userid", $params['userid']);
		$data = $rawData->queryAll();
		return $data;
	} 	
	
	/**
     * @updates the status,role_id
     */
	public function updateAccess($params)
	{	
		$sql = "UPDATE tshirt_access SET status = :status ,role_id = :roleId  WHERE id = :updateId;";	
		$rawData = Yii::$app->db->createCommand($sql);
		$rawData->bindParam(":updateId", $params['id']);
		$rawData->bindParam(":status", $params['status']);
		$rawData->bindParam(":roleId", $params['roleid']);
		$data = $rawData->execute();	
		return $data;		
	} 
	
	/**
     * @inserts the userid,appid,status,role_id
     */
	public function addAccess($params)
	{		
	
		$sql = "INSERT INTO tshirt_access (userid,appid,status,role_id) VALUES (:userid,:appid,:status,:roleId);";	
		$rawData = Yii::$app->db->createCommand($sql);
		$rawData->bindParam(":userid", $params['userid']);
		$rawData->bindParam(":appid", $params['appid']);
		$rawData->bindParam(":status", $params['status']);
		$rawData->bindParam(":roleId", $params['roleid']);
		$data 	= $rawData->queryAll();	
		
		$data 	= Yii::$app->db->createCommand("SELECT id from tshirt_access order by id desc");	
		$row	=$data->queryOne();
		return $row['id'];	
				
	}
	
	public function getAccessUser($params=null)
	{		
		$sql = "select * from tshirt_access where userid=:userid ";
		if(!empty($params['appid']))
			$sql .= " AND appid= :appid ";
		
		$rawData = Yii::$app->db->createCommand($sql);
		$rawData->bindParam(":userid", $params['userid']);
		
		if(!empty($params['appid']))
		$rawData->bindParam(":appid", $params['appid']);
		
		$data 	= $rawData->queryAll();	
		return $data;		
	}
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAppList()
    {
        return $this->hasOne(AppList::className(), ['id' => 'appid']);
    }
}
