<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "heroku_tickets_message".
 *
 * @property integer $id
 * @property integer $ticketid
 * @property integer $adminid
 * @property integer $userid
 * @property string $description
 * @property string $attachment
 * @property string $updated_date
 */
class TicketsMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'heroku_tickets_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticketid', 'adminid','description'], 'required'],
            [['ticketid', 'adminid', 'userid'], 'integer'],
            [['description', 'attachment'], 'string'],
            [['updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticketid' => 'Ticketid',
            'adminid' => 'Adminid',
            'userid' => 'Userid',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'updated_date' => 'Updated Date',
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
			$this->attachment->saveAs('uploads/ticketimage/'.time().$this->attachment->baseName.'.' .$this->attachment->extension);
			$this->attachment = 'uploads/ticketimage/'.time().$this->attachment->baseName.'.'.$this->attachment->extension;
			return true;
	}
	
}
