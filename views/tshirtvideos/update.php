<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TshirtVideos */

$this->title = 'Update Videos: ' . $model->videotitle;
$this->params['breadcrumbs'][] = ['label' => 'Tshirt Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tshirt-videos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
