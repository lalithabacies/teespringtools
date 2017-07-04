<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = $model->blogname;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="blogs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])

		?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'blogname:ntext',
            
			[
                'attribute'=>'Blog Description',
				'value'=>$model->blogdescription,
				// 'format' => 'raw',
				
            ],
			
			[
                'attribute'=>'Blog Image',
				'value'=>!empty($model->blogimage)?Yii::$app->homeUrl.$model->blogimage:'',
				 'format' => !empty($model->blogimage)?['image',['height'=>'100px']]:'text',
				
            ],
			
			[
				 'label'=>'Status',
				 'value' =>($model->status == 1)?"Enable":"Disable",
			]
			
          
        ],
    ]) ?>

</div>
