<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\UserProfile;


/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

	public function captchaGen($length = 6){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		 return $randomString;
	}	
	
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
     public function sendEmail()
    {
		
        // @var $user User 
        $user = UserProfile::findOne([
            'email' => $this->email,
        ]);
			
		
        if (!$user) {
            return false;
        } else 
		{
			$length = 8;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
				
				
			$user->password = $randomString;
			$user->save(false);
			
		$subject = Yii::$app->params['sitetitle'];	
		$message = Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetSuccessMessage-html'],['user'=>$user , 'randomString' => $randomString ]               
            )
            ->setFrom([Yii::$app->params['adminEmail'] => 'Teespring Tools '])
            ->setTo($user->email)
            ->setSubject($subject);
          			
		//$message->getSwiftMessage()->getHeaders()->addTextHeader('MIME-version', '1.0\n');
		//$message->getSwiftMessage()->getHeaders()->addTextHeader('charset', ' iso-8859-1\n');
		
			return $message->send();	
		}			
	
    } 
	
	
}
