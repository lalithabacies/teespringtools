<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$items = array("active","inactive");
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rolename')->textInput(['maxlength' => true]) ?>
	
    <?= Html::activeDropDownList($model, 'status',$items) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
