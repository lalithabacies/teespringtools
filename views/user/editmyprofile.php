<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Edit My Profile ';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">
    <h1><?= Html::encode($this->title) ?></h1>
		 <div class="user-form">


			<?php $form = ActiveForm::begin(); ?>


			<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true]) ?>

			<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true]) ?>

			<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
		
			<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


			<div class="form-group">
				<?= Html::submitButton('Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		 </div>

</div>
