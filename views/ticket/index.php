<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HerokuTicketsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets System';
$this->params['breadcrumbs'][] = $this->title;
$status_array = array(1=>"Opened",0=>"Closed");
?>
<div class="heroku-tickets-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
<div class="row">		
		<div class="col-md-9" >
			
		</div>
		<div class="col-md-3" >
		
			<select class="form-control pull-right" name="app_filter" id="app_filter">
				<option value="">---Select Apps---</option>
				<?php
						if($model)
						{
							foreach($model as $tmp)
							{
								if(isset($appid) && !empty($appid) && ($appid == $tmp->id))
									echo "<option selected='selected' value='".$tmp->id."'>".$tmp->name."</option>";
								else
									echo "<option value='".$tmp->id."'>".$tmp->name."</option>";
							}								
						}
					?>
			</select>
		</div>
    </div>
			
    <?= GridView::widget([
        'dataProvider' => $dataProvider,     
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            // 'id',       
            // 'appid', 
            //'title:ntext',
			[	
				
				'attribute' => 'title:html',
				'label' => 'Title',
				'format' => 'raw',
					 'value'=>function ($data) {
						return Html::a(Html::encode($data->title),'ticket-display?id='.$data->id);
					},
			],
			
			[	
				
				'attribute' => 'userid',
				'label' => 'Username',
				'format' => 'raw',
				'value' => 'userDetails.fullname',				
			],
			
			[	
				
				'attribute' => 'status',
				 'filter' => Html::activeDropDownList($searchModel, 'status',$status_array ,['class'=>'form-control input-sm','prompt' => '--status--']), 
				'value' => function ($model){						
						return ($model->status == 1)?"Opened":"Closed";
                      },	
			],
		
			[	
				
				'attribute' => 'created_date',
				"label" => "Date",
				'value' => function ($model){						
						return date('d-m-Y',strtotime($model->created_date));
                      },	
			],
			
		
            // 'description:ntext',       
            // 'image:ntext',
        

            ['class' => 'yii\grid\ActionColumn','template' => '{update}{delete}',],
        ],
    ]); ?>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$( "#app_filter" ).change(function() {
			$id = $(this).val();
			window.location.href = "<?php echo Yii::$app->homeUrl; ?>ticket/index?id="+$id ;
		});
	});

</script>
