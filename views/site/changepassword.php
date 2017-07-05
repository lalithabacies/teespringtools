<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Changepwd */
/* @var $form ActiveForm */
?>
<div class="site-changepassword">

<?php 

/* echo "<pre>";
print_r(Yii::$app->user->identity->username);
exit; */

		if(Yii::$app->session->hasFlash('change_pwd_success')){ ?>

        <div class="alert alert-success">
            Your Password has been changed Successfully.
        </div>

    <?php } elseif(Yii::$app->session->hasFlash('change_pwd_error')){ ?>

        <div class="alert alert-danger">
            Oops, Something Went Worng Try Again. 
        </div>
	<?php } ?>
	
	
 <div class="row forgotpwd" style="margin-top: 100px;">
    <div class="col-lg-offset-2 col-md-8">
		<?php $form = ActiveForm::begin(); ?>
			<div class="card">
					<div class="card-head style-primary">
							<header>Change Password</header>
					</div>
			 <div class="card-body">		
				<?= $form->field($model, 'oldpassword')->passwordInput(['autofocus' => true,'class'=>"form-control"]) ?>
				<?= $form->field($model, 'newpassword')->passwordInput(['class'=>"form-control"]) ?>
				
				<?= $form->field($model, 'reenternewpassword')->passwordInput(['class'=>"form-control"]) ?>
			
				<div class="form-group">
					<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
				</div>
			 </div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

</div><!-- site-changepassword -->
