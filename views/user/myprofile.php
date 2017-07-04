<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = "My Profile";
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['edit-my-profile'], ['class' => 'btn btn-primary']) ?>       
    </p>

	
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [          
			'username',
            'email:email',
            'firstname',
            'lastname',
            'phone',
        ],
    ]) ?>

</div>
