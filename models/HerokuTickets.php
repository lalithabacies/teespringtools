<?php

namespace app\models;

use Yii;

use app\models\UserProfile;
/**
 * This is the model class for table "heroku_tickets".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $appid
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $image
 * @property string $created_date
 */
class HerokuTickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'heroku_tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title', 'description', 'status'], 'required'],
            [['userid', 'appid', 'status'], 'integer'],
            [['title', 'description', 'image'], 'string'],
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
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'image' => 'Image',
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
	
	public function uploadImage(){
			$this->image->saveAs('uploads/ticketimage/'.time().$this->image->baseName.'.' .$this->image->extension);
			$this->image = 'uploads/ticketimage/'.time().$this->image->baseName.'.'.$this->image->extension;
			return true;
	}
}
