<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$status_array = array(1=>"Opened",0=>"Closed");

/* @var $this yii\web\View */
/* @var $model app\models\HerokuTickets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heroku-tickets-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'title')->textInput() ?>
   	
	<?= $form->field($model, 'appid')->dropDownList(ArrayHelper::map($applist, 'id', 'name'))->label("App Name") ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

	<?php if(!empty($model->image)) {  ?>
		 <img src="<?=$model->image;?>" width="150" height="150" />
	<?php } ?>	
	
    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>
	
	<?php if(!$model->isNewRecord){ ?>
		<?= $form->field($model, 'status')->dropDownList($status_array); ?>
	<?php } ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
