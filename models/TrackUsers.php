<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tshirt_track_users".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $ip_address
 * @property string $location
 * @property string $browser
 * @property string $os
 * @property string $created_date
 */
class TrackUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tshirt_track_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'ip_address', 'browser', 'os'], 'required'],
            [['userid'], 'integer'],
            [['created_date'], 'safe'],
            [['ip_address', 'location', 'browser', 'os'], 'string', 'max' => 250],
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
            'ip_address' => 'Ip Address',
            'location' => 'Location',
            'browser' => 'Browser',
            'os' => 'Os',
            'created_date' => 'Created Date',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'userid']);
    }
	
}
