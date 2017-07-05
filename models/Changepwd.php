<?php

namespace app\models;

use Yii;
use app\models\UserProfile;

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
class Changepwd extends \yii\db\ActiveRecord
{
	
	public $oldpassword;
    public $newpassword;
    public $reenternewpassword;
	public $password;
	
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

            [['oldpassword', 'newpassword','reenternewpassword'], 'required'],			
            [['oldpassword'], 'string' ],
            [['newpassword','reenternewpassword'], 'string','min' => 6 ],
            ['reenternewpassword', 'compare','compareAttribute'=>'newpassword'],     
            ['oldpassword', 'validatePassword'],
        ];
      
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldpassword'=>'Old Password',
            'newpassword'=>'New Password',
            'reenternewpassword'=>'Re-Enter Password'
        ];
    }
	
	
 	public function validatePassword($attribute)
    {

        $this->password = UserProfile::findOne(['username'=>Yii::$app->user->identity->username])->password;
		
        if(trim($this->oldpassword) != trim($this->password))
        {
            $this->addError($attribute, \Yii::t('app', 'Invalid password'));
        }
        else
        {
            return true;
        }
    }  
	
	/**
     * Finds UserProfile by [[username]]
     *
     * @return UserProfile|null
     */
     public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserProfile::findByUsername($this->username);
        }

        return $this->_user;
    } 
	
}
