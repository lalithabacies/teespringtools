<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property integer $status
 * @property string $phone
 * @property string $created_date
 * @property string $last_date
 */
class TshirtUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'firstname', 'lastname', 'status', 'phone', 'last_date'], 'required'],
            [['status'], 'integer'],
            [['created_date', 'last_date'], 'safe'],
            [['username', 'password', 'email', 'firstname', 'lastname', 'phone'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'status' => 'Status',
            'phone' => 'Phone',
            'created_date' => 'Created Date',
            'last_date' => 'Last Date',
        ];
    }
}
