<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DomainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Domain Management';
$this->params['breadcrumbs'][] = $this->title;
$status_array = array(1=>"Enable",0=>"Disable");	
?>
<div class="domain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="row">		
		<div class="col-md-6" >
			<?= Html::a('Create Domain', ['create'], ['class' => 'btn btn-success']) ?>
		</div>
		<div class="col-md-6" >
			<a class="btn btn-danger pull-right" id="multi_delete" name="multi_delete" >Multi Delete</a>
		</div>
    </div>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
		
			[	
					'class' => 'yii\grid\CheckboxColumn',
					'checkboxOptions' => function ($data){
						return ['checked' =>false,'value'=>$data['id']];
					}, 				
			],
	
			[	
				'attribute' => 'name',
				'label' => 'Domain Name',
				'value' => function ($model){
						return $model->name;
                      },	
			],
			
            [	
				'attribute' => 'description',
				'label' => 'App Details',
				'format' => 'raw',
				'value' => function ($model){
						return $model->description;
                      },	
			],
			
			[	
				'attribute' => 'applink',
				'label' => 'DNS Target',
				'value' => 'appDetails.applink',
			],
			
			[	
				'attribute' => 'date',
				'label' => 'Date',
				'format' => 'raw',
				'value' => function ($model){
						return date('d-M-Y H:i A',strtotime($model->date));
                      },	
			],
			
            ['class' => 'yii\grid\ActionColumn','template' => '{update}{delete}',],
        ],
    ]); ?>
</div>



	<script type = "text/javascript">
 
     $(document).ready(function(){	
	 
		$("#multi_delete").click(function(){				 
		    var r = confirm("Are you Sure To Delete!");
		    if (r == true) {
				var domain_id = $.map($('input[name="selection[]"]:checked'), function(c){return c.value; })
				if($.trim(domain_id) === "")
				 {
					alert("Please Select the Checkbox to Delete!!!.");
					return false;
				  }				
				 $.ajax({
				   url: '<?=Yii::$app->homeUrl."domain/multi-delete"?>',
				   type: 'POST',
				   data: {  domain_id: domain_id,
				   },
				   success: function(data) {												
						location.reload();
				   }
				 }); 
				}		
			 });			 			 
	});
		 
      </script> 
	  