<?php
 
namespace app\components;

use Yii;
 
/* @Description: User define Customize Access Rule
 * It will Provide access to Controller Action according to
 * access Rule define here.
 * @Created: 27-June-2017
*/
class AccessRule extends \yii\filters\AccessRule {
 
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === 'admin') {
                if ($user->getIsGuest()) {
                    return false;
                } else{
                    $isAdmin = Yii::$app->session->get('isAdmin');
                    if($isAdmin){
                        return true;
                    } else{
                        return false;
                    }
                }
                return true;
            } elseif (!$user->getIsGuest() && $role === $user->identity->role) {
                // Check if the user is logged in, and the roles match
                return true;
            } else{
                return false;
            }
        }
 
        return false;
    }
}
?>