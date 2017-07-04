<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ManageKey */

$this->title = 'Create Manage Key';
$this->params['breadcrumbs'][] = ['label' => 'Manage Keys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-key-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
