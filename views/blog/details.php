<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = $model->blogname;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div  id="content">
	<section>
		<div class="section-body contain-lg">
			<div class="card card-outlined style-primary">
				<div class="card-body table-responsive">
					<?php if(!empty($model)) { ?>					
						<article>
							<h2><?=$model->blogname?></h2>
							<div class="row">
								<div class="group1 col-sm-6 col-md-6">									
									<span class="glyphicon glyphicon-bookmark"></span> 
									<?php echo $model->userDetails->fullname; ?>
								</div>
								<div class="group2 col-sm-6 col-md-6">
									<span class="glyphicon glyphicon-pencil"></span> 
									<a href="#detailBox"><?php echo count($model->blogsComments); ?> Comments</a>
									<span class="glyphicon glyphicon-time"></span> 
									<?=date('M-d-Y h:i A',strtotime($model->modifieddate))?>	
								</div>
							</div>
							<hr>
								<?php
									if($model->blogimage) {
								?>
									<img src="<?=Yii::$app->homeUrl.$model->blogimage?>" class="img-responsive" style="max-width:200px">
								<?php 
									} else {
								?>
									<img src="http://placehold.it/900x300" class="img-responsive">
								<?php 
									}
								?>
								<br />
								<div><?=json_decode($model['blogdescription']);?></div>
								<div><?=$model->blogdescription;?></div>
							<hr>							
						</article>					
					<?php } else { ?>
						<div class="alert alert-warning">
							NO RESULTS FOUND
						</div>
					<?php } ?>
					<div class="detailBox" id='detailBox'>
						<div class="titleBox">
						  <label>Comment Box</label>
							<button type="button" class="close" aria-hidden="true">&times;</button>
						</div>
						<div class="commentBox">
							
							<p class="taskDescription">Latest Comments</p>
						</div>
						<div class="actionBox">
							<ul class="commentList">
								<?php 
									foreach($blogcomments as $comments) {
										
								?>
								<li <?= ($comments->status ==0)? 'style="background-color:#dddddd"':''?>>
									<div class="commenterImage">									  
									  <span class="glyphicon glyphicon-user"></span>
									</div>
									<div class="commentText">
										<p class=""><?=$comments->comments; ?>
											<?php
											if(isset($_SESSION['is_admin'])&& ($_SESSION['is_admin'] == true))
											{												
											?>
												<a style='cursor: pointer;' class='action' data-mode='enable_blog' data-id =<?=$comments->id ?> >enable</a>
												<a style='cursor: pointer;' class='action' data-mode='disable_blog' data-id =<?=$comments->id ?>>disable</a>
												<a style='cursor: pointer;' class='action' data-mode='delete_blog' data-id =<?=$comments->id ?>>delete</a>
											<?php 
											}
											?>
										</p>
										<span class="date sub-text">
											<?php echo $comments->userDetails->fullname; ?>
											on 
											<?=date('M-d-Y h:i A',strtotime($comments->createddate))?>
										</span>

									</div>
								</li>
								<?php 
									}
								?>								
							</ul>
							
					<?php $form = ActiveForm::begin(['action' =>['blog/add-blog-comments']]); ?>
				 
							<?= $form->field($newblogcmt, 'comments')->textarea(['rows' => 2]); ?>			
									
							<?= $form->field($newblogcmt, 'blog_id')->hiddeninput(['value'=>$model->id])->label(false) ?>
					<div class="form-group">
						<?= Html::submitButton('Post', ['class' =>'btn btn-primary']) ?>
					</div>
					
					<?php ActiveForm::end(); ?>
				
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="?page=view_blogs">
						<button type="button" class="btn btn-info">
							<i class="md-navigate-before"></i> BACK
						</button>
					</a>
				</div>
			</div>
		</div>
	</section>
</div>