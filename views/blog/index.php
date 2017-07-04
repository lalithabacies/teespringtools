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

	<div class="row">		
		<div class="col-md-6" >
			<?= Html::a('Create Blogs', ['create'], ['class' => 'btn btn-success']) ?>
		</div>
		<div class="col-md-6" >
			<a class="btn btn-danger pull-right" id="multi_delete" name="multi_delete" >Multi Delete</a>
		</div>
    </div>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       [	
					'class' => 'yii\grid\CheckboxColumn',
					 'checkboxOptions' => function ($data){
						return ['checked' =>false,'value'=>$data['id']];
					}, 
				
			],
			
            'blogname:ntext',
            //'blogdescription:ntext',
			
			[	
				'attribute' => 'blogdescription',
				'format' => 'raw',
				'value' => function ($model){
						return substr($model->blogdescription,0,120)."...";
                      },	
			],
			
            //'blogimage:ntext',
            //'createddate',
            // 'createdby',
            // 'modifieddate',
            // 'modifiedby',
           
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


 <script type = "text/javascript">
 
     $(document).ready(function(){	
	 
		$("#multi_delete").click(function(){				 
		    var r = confirm("Are you Sure To Delete!");
		    if (r == true) {
				var blog_id = $.map($('input[name="selection[]"]:checked'), function(c){return c.value; })
				if($.trim(blog_id) === "")
				 {
					alert("Please Select the Checkbox to Delete!!!.");
					return false;
				  }				
				 $.ajax({
				   url: '<?=Yii::$app->homeUrl."blog/multi-delete"?>',
				   type: 'POST',
				   data: {  blog_id: blog_id,
				   },
				   success: function(data) {												
						location.reload();
				   }
				 }); 
				}		
			 });			 			 
	});
		 
      </script> 
	  