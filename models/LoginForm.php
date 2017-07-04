<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;
    private $uid;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {           
            $this->_user = User::findByNewUsername(); //added by developer;        
            //$this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /* @ User Define Function
     * @Description: As tshirt_user table doesn't follow Yii2 complaince.
     * Table name is not users for this , we use a custom function to do workaround.
     * @Created: 23-June-2017
    */
    public function setUserLogin($params)
    {
        $this->username = $params['username'];
        $this->password = $params['password'];
        $this->rememberMe = $params['rememberme'];
          
        $connection = Yii::$app->getDb();
        $sql = 'SELECT * FROM tshirt_users WHERE username=:username AND password=:pass';
        $user = $connection->createCommand($sql);
        $user->bindValue(':username', $this->username);
        $user->bindValue(':pass', $this->password);
        $result = $user->queryAll();
        if (isset($result[0]['username']) && $result[0]['username']==$this->username){
            $username = $result[0]['username'];         
            $this->uid = $result[0]['id'];
            $isAdmin = false;
            //Set User Session
            $userSessionArray = array('username'=>$this->username,'password'=>$this->password,
            'uid'=>$this->uid);
            Yii::$app->session->set('custUserData',$userSessionArray);
            if($result[0]['id']==1 || $result[0]['id']==69) {
                $isAdmin = true;
            }
            Yii::$app->session->set('isAdmin',$isAdmin);
            $expireTime = $this->getIdentitySessionTime();    
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? $expireTime : 0);            
            return true;
        } else{
            return false;
        }
    }
    
    /* @ User Define Function
     * @Description: return, time in seconds (INT)   
     * @Created: 27-June-2017
    */
    private function getIdentitySessionTime()
    {
        /* _identity cookie expire Time
        Format: secs * hrs * days
        old value = 3600*24*30 - httponly
        3600*24*30  is 1 month expireTime
        1hr = 3600 secs, 24hr * 3600 sec = 86400 sec
        3600*24*1 - 24hrs/1day Expiretime
        */
        $return = 3600*24*1;
        return $return;
    }
    
}
