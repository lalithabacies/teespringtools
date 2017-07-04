<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use  yii\web\Session;
//class User extends \yii\base\Object implements \yii\web\IdentityInterface
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 10;
    
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ]              
    ];
    
    public static function tableName()
    {
        return 'tshirt_users';
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $userData = Yii::$app->session->get('custUserData');
        if (isset($userData['uid'])){
            self::setUserArray();
        }
        //Above code is newly added
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {        
        foreach (self::$users as $user) {          
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    
    /* @ User Define Function
     * @Description: To Manipulate UserArray for app-user Identity creation.
     * As On login the user information is stored in Yii::$app->user->identity variable
     * @Created: 26-June-2017
    */
    public static function findByNewUsername()
    {
        $userData = Yii::$app->session->get('custUserData');
        $id = $userData['uid'];
        $username = $userData['username'];
        $password = $userData['password'];
        $userArray = array('id' => $id,'username' => $username,'password' => $password,
        'authKey' => 'test'.$id.'key','accessToken' => $id.'-token');
        $userArray = (object) $userArray;
        self::setUserArray();    
        return new static($userArray);
    }
    
    /* @ User Define Function
     * @Description: AS we are doing a workaround of Validation functionality
     * so, currentUser Details needs to add to static variable users for user-Indentity creation.
     * so that findByUsername,findIdentity function return users details.
     * @Created: 26-June-2017
    */
    public static function setUserArray()
    {  
        $userData = Yii::$app->session->get('custUserData');
        $id = $userData['uid'];
        $aa = array(
            'id' => $userData['uid'],
            'username' => $userData['username'],
            'password' => $userData['password'],
            'authKey' => 'test'.$userData['uid'].'key',
            'accessToken' => $userData['uid'].'-token',
        );
        self::$users[$id] = $aa;
    }    
    
}