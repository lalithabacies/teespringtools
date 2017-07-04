<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HerokuTickets */

$this->title = 'Create Heroku Tickets';
$this->params['breadcrumbs'][] = ['label' => 'Heroku Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heroku-tickets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
