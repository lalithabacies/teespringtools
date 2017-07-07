<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
  
/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

$roles = \yii\helpers\ArrayHelper::map(\app\models\Roles::find()->orderBy('id ASC')->all(),'id','rolename');	

?>
<div id="content1232">
 <section>
<div class="user-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($role, 'id')->dropDownList($roles)->label("User Role"); ?>
        
												
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
	
	
	
	<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
		
	<?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true]) ?>
		

	
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Register', ['class' =>'btn btn-success']) ?>
		<?= Html::a('Cancel', ['site/login'], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	</div>
</div>
 </section>
</div>