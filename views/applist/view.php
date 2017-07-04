<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AppList */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'App Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [       
            'name',
            'link:ntext',
            'description:ntext',
			[
                'attribute'=>'Image Link',
				'value'=>!empty($model->image_link)?Yii::$app->homeUrl.$model->image_link:'',
				 'format' => !empty($model->image_link)?['image',['height'=>'100px']]:'text',
				
            ],
			
        ],
    ]) ?>

</div>
