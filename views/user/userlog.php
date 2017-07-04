<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserProfile */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Log';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           
			[	
				
				'attribute' => 'userid',
				'label' => 'Username',
				'format' => 'raw',
				'value' => 'userDetails.fullname',				
			],
			
            'ip_address',
            'location',
            'browser',
            'os',
            'created_date',

        ],
    ]); ?>
</div>
