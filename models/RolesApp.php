<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class RolesApp extends ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'roles_app';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'roleid' => 'RoleId',
            'appid' => 'AppId',
            'status' => 'Status',
            'created_date' => 'Create Date',            
        ];
    }   
}