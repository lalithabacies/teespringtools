<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\User;

class UserRole extends ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'userrole';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'roleid' => 'RoleId',
            'userid' => 'UserId',           
        ];
    }
    
    /* User Define Function
    * To fetch all Users with their Role. (1:1)
    * Returns username with their role, if No records in userrole will add Null
    * @Created:30/6/2017
    */
    public function getUserRoles($pno=0,$limit=10)
    {
        $column = 'tshirt_users.id,tshirt_users.username,userrole.id as userroleid,userrole.roleid';
        $userRole = User::find()->select($column)->leftJoin('userrole', 'tshirt_users.id = userrole.userid')
        ->limit($limit)->offset($pno)->orderBy(['(tshirt_users.id)' => SORT_DESC])->asArray()->all();
        return $userRole;
    }
	
	/* User Define Function
    * To fetch all Users with their Role. (1:1)
    * Returns no of username with their role, if No records in userrole will add Null
    * @Created:04/07/2017
    */
	public function getNoofUserRoles()
    {
        $column = 'tshirt_users.id,tshirt_users.username,userrole.id as userroleid,userrole.roleid';
        $userRole = User::find()->select($column)->leftJoin('userrole', 'tshirt_users.id = userrole.userid')->orderBy(['(tshirt_users.id)' => SORT_DESC])->asArray()->all();
        return count($userRole);
    }

}