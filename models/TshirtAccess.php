<?php

namespace app\models;

use Yii;

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
}
