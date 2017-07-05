<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="password-reset">


Dear <?php  echo $user->firstname." ".$user->lastname ?>,<br>
<br>Your password for Central Hub has been reset and the details are as follows:
<br>Username : <?php  echo $user->username ?>
<br>Password : <?php  echo $randomString?>
<br>NOTE:We advice you to change your password after logging in.
<br><br>Best Regards,<br> Central Hub.
			
				
				
</div>
