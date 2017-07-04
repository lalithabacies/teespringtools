<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppList */

$this->title = 'Create App List';
$this->params['breadcrumbs'][] = ['label' => 'App Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
