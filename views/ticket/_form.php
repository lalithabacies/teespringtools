<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$session = Yii::$app->session;
$status_array = array(1=>"Opened",0=>"Closed");

/* @var $this yii\web\View */
/* @var $model app\models\HerokuTickets */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
 $newapplist = [];
 if(empty($session['isAdmin']) &&( Yii::$app->user->id)){
		
		foreach($applist as $key=>$tmp)
		{
			$newapplist[$key]["id"]= $tmp->userAppList->id;
			$newapplist[$key]["name"]=$tmp->userAppList->name;
		}
	} 

?>
<div class="heroku-tickets-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'title')->textInput() ?>
	
   	<?php if(!empty($session['isAdmin'])){ ?>
	
	<?= $form->field($model, 'appid')->dropDownList(ArrayHelper::map($applist, 'id', 'name'),['disabled' => 'disabled'])->label("App Name") ?>
	
	<?php } else if(Yii::$app->user->id){ ?>	
	
	<?= $form->field($model, 'appid')->dropDownList(ArrayHelper::map($newapplist, 'id', 'name'))->label("App Name") ?>
	
	<?php } ?>
	
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
