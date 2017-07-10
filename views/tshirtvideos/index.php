<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TshirtVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tshirt Videos';
$this->params['breadcrumbs'][] = $this->title;
$status_array = array(1=>"Enable",0=>"Disable");	
?>
<div class="tshirt-videos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tshirt Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'videotitle',
            'emdedurl:text',
            'createdon',
            [
				'attribute' => 'status',
				'value' => function ($model)use($status_array){
					return ($model->status == 1)?"Enable":"Disable";
                                },		
				 'filter' => Html::activeDropDownList($searchModel, 'status',$status_array ,['class'=>'form-control input-sm','prompt' => '--status--']), 
			
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
