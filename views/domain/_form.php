<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Domain */
/* @var $form yii\widgets\ActiveForm */
$items = array("1"=>"Public",'0'=>"Private");
?>

<div class="domain-form">

    <?php $form = ActiveForm::begin(); ?>

						
    <?php //$form->field($setting, 'publicdomainNameLinkId') ->dropDownList($items) ?>
	
	
	<div class="form-group field-domainsettings-publicdomainnamelinkid">
	<label class="control-label" for="domainsettings-publicdomainnamelinkid">Access Level</label>
		<select id="domainsettings-publicdomainnamelinkid" class="form-control" name="DomainSettings[publicdomainNameLinkId]">
			
			<?php if($model->isNewRecord){ ?>
				<option value="1">Public</option>
				<option value="0">Private</option>
			<?php } else { ?>
				<?php if(!empty($setting->sval)){ ?>	
				<option selected="selected" value="1">Public</option>
				<option value="0">Private</option>
				<?php } else if(empty($setting->sval)){ ?>
				<option value="1">Public</option>
				<option selected="selected" value="0">Private</option>
				<?php } ?>
			<?php } ?>
		</select>

	<div class="help-block"></div>
	</div>	

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

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
