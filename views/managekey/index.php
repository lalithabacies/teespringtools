<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ManageKeySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Keys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manage-key-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Manage Key', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'domain',
            'salt_key:ntext',
            
          
            // 'created_date',
            // 'access_time',

            ['class' => 'yii\grid\ActionColumn','template' => '{update}{delete}',],
        ],
    ]); ?>
</div>
