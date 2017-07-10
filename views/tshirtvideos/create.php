<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TshirtVideos */

$this->title = 'Create Tshirt Videos';
$this->params['breadcrumbs'][] = ['label' => 'Tshirt Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tshirt-videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
