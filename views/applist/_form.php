<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-list-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?php if(!empty($model->image_link)) {  ?>
		 <img src="<?= \Yii::$app->homeUrl.$model->image_link;?>" width="150" height="150" />
	<?php } ?>
	
	<?= $form->field($model, 'image_link')->fileInput(['class' => 'form-control']) ?>
   
    <?= $form->field($model, 'link')->textInput(['rows' => 6]) ?>
	
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
