<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blogs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'blogname')->textInput() ?>

    <?php // $form->field($model, 'blogdescription')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'blogdescription')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full',
	
    ]); ?>	
	
	<?php if(!empty($model->blogimage)) {  ?>
		 <img src="<?= \Yii::$app->homeUrl.$model->blogimage;?>" width="150" height="150" />
	<?php } ?>
	
	
    <?= $form->field($model, 'blogimage')->fileInput(['class' => 'form-control']) ?>

    <?php //echo $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

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
