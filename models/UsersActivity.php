<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_activity".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $appid
 * @property integer $status
 * @property string $created_date
 */
class UsersActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'appid'], 'required'],
            [['userid', 'appid', 'status'], 'integer'],
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
        ];
    }
}
