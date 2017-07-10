<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TshirtVideos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tshirt-videos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'videotitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emdedurl')->textInput(['maxlength' => true]) ?>


		<?php 
		if($model->isNewRecord)
		{
			$model->status = 1;
		} 
		else 
		{
			if($model->status == 1)
				$model->status=1;
			else	
				$model->status=0;
		}
		
		echo $form->field($model, 'status')->radioList([1 => 'Enable', 0 => 'Disable'],['class' => 'radio radio-styled'])->label('Status');  ?>
		
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
