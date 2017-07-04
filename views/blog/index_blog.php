<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BlogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
$status_array = array(1=>"Enable",0=>"Disable");	

?>
<div class="blogs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [       
            //'blogname:ntext',
           
			[	
				
				'attribute' => 'Lastes Blog Posts',
				'format' => 'raw',
				'value' => function ($model){
						
						$message = "<h2>
									  <a href='".Yii::$app->homeUrl."blog/view-blog?id=".$model->id."'>".$model->blogname."</a>
									 </h2><br>";
						$message .= "<div class='row'>
										<span class='glyphicon glyphicon-bookmark'></span>".$model->userDetails->fullname." 
										<span class='glyphicon glyphicon-pencil'></span> 
											<a href='".Yii::$app->homeUrl."blog/view-blog?id=".$model->id."'>".count($model->blogsComments)."  Comments</a>
										<span class='glyphicon glyphicon-time'></span>".date('M-d-Y h:i A',strtotime($model->modifieddate))."
										</div>";
													
						$message .= substr($model->blogdescription,0,120);
						$message .= " <a href='".Yii::$app->homeUrl."blog/view-blog?id=".$model->id."' class='text-right btn-link'>more...</a>";
						return $message;
                      },	
			],
			
        ],
    ]); ?>
</div>

