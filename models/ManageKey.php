<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_manage_key".
 *
 * @property integer $id
 * @property string $domain
 * @property string $salt_key
 * @property string $encrypted_data
 * @property integer $status
 * @property string $created_date
 * @property string $access_time
 */
class ManageKey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_manage_key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'salt_key'], 'required'],
            [['salt_key', 'encrypted_data'], 'string'],
            [['status'], 'integer'],
            [['created_date'], 'safe'],
            [['domain'], 'string', 'max' => 250],
            [['access_time'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain' => 'Domain',
            'salt_key' => 'Salt Key',
            'encrypted_data' => 'Encrypted Data',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'access_time' => 'Access Time',
        ];
    }
}
