<?php
/* @var $this yii\web\View */

$this->title =  Yii::$app->params['sitetitle'];
$loginsession     =  \Yii::$app->session->get('custUserData');
$cookies=Yii::$app->getRequest()->getCookies();
$_identity =$cookies['_identity'];
$tokenarr = explode(",",$_identity);
$token = str_replace('"','',$tokenarr[1]);
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
														
													</td>
													<td>
														<?php echo $tmp->userAppList->name; ?></br></br>
														<?php echo $tmp->userAppList->description; ?>
													</td>
													<td> 
													    
														<a target="_blank" href="<?php echo $tmp->userAppList->link; ?>?mail=<?=base64_encode($loginsession['email'])."token=".addslashes($token)?>" style="text-decoration:none;">	
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

