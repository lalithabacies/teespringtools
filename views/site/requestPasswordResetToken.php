<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request Password Reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main_page container">
<div class="site-request-password-reset">
    <h1 class="fnt-green" ><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email address.</p>

		<?php 
$sessioncheck = Yii::$app->session->getFlash('error');
if(isset($sessioncheck) && !empty($sessioncheck)) { ?>
<div id="w3-danger-0" class="alert-danger alert fade in">
<button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
<?= Yii::$app->session->getFlash('error'); ?>
</div>
<?php } ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
					<?= Html::a('Cancel', ['site/login'], ['class'=>'btn btn-danger']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>

