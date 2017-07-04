<?php
/* @var $this yii\web\View */

$this->title =  Yii::$app->params['sitetitle'];
?>


<div id="content" style="padding-top: 0px;">
	<section>
		<div class="section-body contain-lg">&nbsp;
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-12" style="margin-bottom: 10px;">
						<h1 class="text-primary">Applications </h1>
					</div>	
						<div class="card-body tab-content">&nbsp;
								<div class="col-md-12">
									<?php
									  if($checkdata)
									  {																					  
										  ?>
										<table class="table no-margin" style="visibility: visible !important;" >
											<thead>
												<tr>
													<th style="display:none;" class="col-md-2">Appimage</th>
													<th class="col=md-8">Application</th>
													<th class="col-md-2">&nbsp;</th>
												</tr>
											</thead>
											
											<div id="accordion0" class="panel-group">
											<tbody>
												<?php
												foreach($checkdata as $tmp)
												{		
												?>
												<tr>
													<td style="display:none;" >
														<img class="img-circle img_style" src="<?php echo $tmp->image_link; ?>"/>
													</td>
													<td>
														<?php echo $tmp->name; ?></br></br>
														<?php echo $tmp->description; ?>
													</td>
													<td> 
													    
														<a target="_blank" href="<?php echo $tmp->link; ?>" style="text-decoration:none;">	
														   <li class="md md-send"><span id="color_img"><img src="<?php echo \Yii::$app->homeUrl; ?>css/img/rocket.png"></span>
																	
															</li>
														</a>
													</td>
												</tr>
												<?php
												}											
												?>
												</tbody>				  
											</div><!--end .panel-group -->						
										</table>
											
											<?php
											}
											else
											{
												?>
												<div class="panel-group">					
													<div class="card panel">
														<div aria-expanded="false?>" data-parent="#accordion1" data-toggle="collapse" class="card-head collapsed">
															<header>No Results Found..</header>
														</div>
													</div>														
												</div>
											<?php	
											}
											?>
											
							</div>											
					</div>
				</div>
			</div>
		</div>
	</section>	
</div>


<style>
.accimg{
	width:100px;
	margin:12px 0px 0px;
}
</style>


