<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

use app\models\RolesApp;
use app\models\UserRole;
use app\models\TshirtAccess;

class Roles extends ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'roles';
    }
    
    public function rules()
    {
        return [
            [['rolename'], 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'rolename' => 'Name',
            'cate' => 'Created Date',
            'createdby' => 'Created By',
            'status' => 'Status',
            'default_access' => 'Default Access',
        ];
    }

    /* User Define Function
    * To fetch, arrange & return apps with their Role as Array (1:M)
    * Returns Apps Details. if No records in roles_app, will add Null
    * @Created:28/6/2017
    */
    public function getAppWithRole()
    {
        $data = '';
        $connection = Yii::$app->getDb();
        $sql = 'SELECT app.id as appid,app.name as appname,rp.id as roleappid,';
        $sql.= ' rp.roleid as roleid,rp.status as status FROM tshirt_app app ';
        $sql.= ' LEFT JOIN roles_app as rp ON app.id = rp.appid';
        $sql.= ' ORDER by app.name,rp.roleid DESC';
        $app = $connection->createCommand($sql);
        $result = $app->queryAll();
        if (count($result)>0){
            $tmpArray = array();
            foreach($result as $keys=>$values){
                $tmpArray[$values['appid']]['appid'] = $values['appid'];
                $tmpArray[$values['appid']]['appname'] = $values['appname'];
                if(!empty($values['roleappid'])){
                    $tmpArray[$values['appid']]['approle'][] = array('roleappid'=>$values['roleappid'],
                    'roleid'=>$values['roleid'],'status'=>$values['status']);
                } else{
                    $tmpArray[$values['appid']]['approle'] = array();
                }
            }
            $data = $tmpArray;
            unset($tmpArray);
        }
        return $data;
    }
    
    public function afterDelete()
    {
        $id = $this->id;
        parent::afterDelete();
        $accessTable = TshirtAccess::tableName();
        $userRoleTable = UserRole::tableName();
        $rolesAppTable = RolesApp::tableName();   
        $connection = Yii::$app->getDb();
        $transaction = $connection->beginTransaction();
        try {
            $sql1 = "DELETE FROM ".$accessTable." WHERE role_id=$id";
            $sql2 = "DELETE FROM ".$userRoleTable." WHERE roleid=$id";
            $sql3 = "DELETE FROM ".$rolesAppTable." WHERE roleid=$id";
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            $connection->createCommand($sql3)->execute();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            //throw $e;
        }
    }
    
    /* User Define Function
    * To Update Role's Status
    * @Created:10/7/2017
    */
    public function updateStatusOnly($id, $status)
    {
        $table = self::tableName();
        $connection = Yii::$app->getDb();
        $sql = "UPDATE ".$table." SET status='".$status."' WHERE id='".$id."'";
        $app = $connection->createCommand($sql);
        $result = $app->queryAll();
    }

}