<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$status_array = array(1=>"Opened",0=>"Closed");

?>
<div id="content" >
	<section>
		<div class="section-body contain-lg">
		<?php
		
		if(isset($model)&& $model)
		{
			
		?>
			<div class="row">
				<div class="col-md-12">
					<div style="margin-bottom: 10px;">
						<h1 class="text-primary"><?php $ticket->title ?></h1>
					</div>
					<ul class="list-comments">
					
					<li>
								<div class="card">
									<div class="comment-avatar"><i class="glyphicon glyphicon-user opacity-50"></i></div>
									<div class="card-body">&nbsp;
										<h4 class="comment-title">
											<?= $ticket->userDetails->fullname; ?> 
											<small><?= date('d/m/Y H:m:s',strtotime($ticket->created_date))?></small>
										</h4>
										<h4 class="comment-title" style="color: #0aa89e;">
											Status: <small><?= $status_array[$ticket->status]; ?> </small>
										</h4>
										
										<p>
										<?php
										if($ticket->image )
										{
											?>
											<br/>
										<a href="<?= $ticket->image ?>" data-lightbox="<?= $ticket->image ?>" ><img src="<?= $ticket->image ?>" alt="Image" style="width:70px;height:70px;"/></a>
										
										<?php
										}
										?>
										<?= $ticket->description ?>
										</p>
										
									</div>
								</div><!--end .card -->
							</li><!-- end comment -->
							
					<?php
						$cnt=count($model);
						foreach($model as $details)
						{
							
					?>
							<li>
								<div class="card">
									<div class="comment-avatar"><i class="glyphicon glyphicon-user opacity-50"></i></div>
									<div class="card-body">&nbsp;
										<h4 class="comment-title">
											<?= $details->userDetails->fullname;?> 
											<small><?= date('d/m/Y H:m:s',strtotime($details->updated_date))?></small>
										</h4>
										<h4 class="comment-title" style="color: #0aa89e;">
											Status: <small><?= $status_array[$ticket->status]; ?></small>
										</h4>
										
										<p>
										<?php
										if($details->attachment)
										{
											?>
											<br/>
										<a href="<?= $details->attachment?>" data-lightbox="<?= $details->attachment ?>" ><img src="<?= $details->attachment ?>" alt="Image" style="width:70px;height:70px;"/></a>
										
										<?php
										}
										?>
										<?= $details->description ?>
										</p>
										
									</div>
								</div><!--end .card -->
							</li><!-- end comment -->
						<?php
						}
						?>
							
					</ul>
				</div>
			</div>
			
			<div class="row">
							<div class="col-md-9">
								<h4>Reply To Ticket</h4>
																
									<?php $form = ActiveForm::begin(['id' => 'contact-form','options' => ['enctype'=>'multipart/form-data']]); ?>

									<?= $form->field($ticket, 'status')->dropDownList($status_array); ?>
									
									<?= $form->field($model1, 'description')->textarea(['rows' => 2]) ?>

									<?php if(!empty($model1->attachment)) {  ?>
										 <img src="<?= \Yii::$app->homeUrl.$model1->attachment;?>" width="150" height="150" />
									<?php } ?>	
									
									<?= $form->field($model1, 'attachment')->fileInput(['class' => 'form-control']) ?>
									<?= $form->field($model1, 'ticketid')->hiddenInput(['class' => 'form-control','value'=>$ticket->id ])->label(false); ?>
									<?= $form->field($model1, 'userid')->hiddenInput(['class' => 'form-control','value'=>$ticket->userid])->label(false); ?>
									

									<div class="form-group">
									   <a href="<?=Url::to(["ticket/index"]); ?>" class="btn btn-primary ">CANCEL</a>
										<?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
									</div>

									<?php ActiveForm::end(); ?>
		
							</div><!--end .col -->
						</div><!--end .row -->
		<?php } ?>						
	</div>
  </section>
</div>						