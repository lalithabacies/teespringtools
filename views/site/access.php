<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title =  Yii::$app->params['sitetitle'];

$per_page	=	25;

//$total_cnt	= count($users);
$total_page	= ceil($total_cnt/$per_page);
$pno = isset($_GET['pno'])?$_GET['pno']:'0';
$contactSearch=isset($_GET['search'])?$_GET['search']:'';
?>

<div id="content" style="padding-top: 0px;">
	<section>
		<div class="section-body contain-lg">&nbsp;

			<div class="row">

				<div class="col-md-12">

					<div class=" card-head ">
						<h1 class="text-primary pull-left">Access Settings</h1>
						<div class="tools pull-right" style="margin-top: 15px;">
							<!--<form class="navbar-search" action='access' role="search" id="form_user_submit" name="form1" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="input_search" name="contactSearch" placeholder="Enter your keyword">
								</div>
								<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
							</form>-->
							<div class="form-group">
							<?=Html::textInput('contactSearch',$contactSearch,["id"=>"input_search","class"=>"form-control","placeholder"=>"Enter your keyword"]);?>
							</div>
						</div>
						
						
					</div>


					
					<!-- BEGIN SEARCH RESULTS PAGING -->
						<?php
						if($total_page>1)
						{
							?>
							<div class="text-center">
								<ul class="pagination">
									<?php
									for($p=1;$p<=$total_page;$p++)
									{
										$class='';
										if($p==($pno+1))
											$class="class='active'";
										?>
										<li <?=$class ?>>
										<?=Html::a($p,['access','pno'=>($p-1)])?>
										</li>
									<?php
									}
									?>
								</ul>
							</div><!--end .text-center -->
		<?php
						}
							?>
												<!-- BEGIN SEARCH RESULTS PAGING -->
				
				
					
						<div class="card-body tab-content">&nbsp;
						
							<div class="col-md-12">
								<?php
								if(Yii::$app->user->identity->id)
								{

								?>
									<table class="table no-margin" id="new_style">
										
										<tr>
											<td class="col-md-1 ">&nbsp;</td>
												<?php
												for($p=0;$p<count($app_arr);$p++)
												{
												?>
													<td class="col-md-1" align='right'>
														<label class="checkbox-inline checkbox-styled">
														<input type="checkbox"  value='all'  name='app_all_status[]' id="<?=$app_arr[$p]['id']?>"  class="app_all_Stat">
														</label>
													</td>
												<?php
												}
												?>

										</tr>
										
									</table>
								
									<table class="table no-margin" id="new_style">
										<thead>
											<tr>
												<th class="col-md-1 style_bold ">Username</th>
												<?php
												for($k=0;$k<count($app_arr);$k++)
												{
												?>
													<th class="col-md-1 style_bold">
														<?php echo $app_arr[$k]['name']; ?>
													</th>
												<?php
												}
												?>

											</tr>
										</thead>

										<div id="accordion0" class="panel-group">
											<tbody>

												<?php
												for($i=0;$i<count($users);$i++)
												{
													$data['userid']	=	$users[$i]['id'];
													//$acc_arr		=	access::getAccessUser($data);
													$access_appid	=	array();
													$access_id		=	array();
													if($acc_arr)
													{
														foreach($acc_arr as $accval)
														{
															if($accval['status']	!=0	)
															$access_appid[]	=	$accval['appid'];
															$access_id[$accval['appid']]	=	$accval['id'];
														}

													}	

													?>

													<tr>
														<td><?php echo $users[$i]['username']; ?></td>
														<?php
														for($j=0;$j<count($app_arr);$j++)
														{
															$checked	= $accid =	"";
															if(in_array($app_arr[$j]['id'],$access_appid))
															{
																$checked	=	"checked='checked'";
															}
															if(isset($access_id[$app_arr[$j]['id']]))
																$accid		=	$access_id[$app_arr[$j]['id']];
															?>
															<td>
																<input type='hidden' name='hid_app' class="hid_app" value="<?= $app_arr[$j]['id'] ?>">
																<input type="hidden" name='hid_acc' class="hid_acc" id="acc_<?= $users[$i]['id'].$app_arr[$j]['id'] ?>"  value="<?= $accid ?>">
																<label class="checkbox-inline checkbox-styled">

																	<input type="checkbox" userId="<?= $users[$i]['id']?>" value='1' <?=$checked?> name='app_status<?=$app_arr[$j]['id']?>[]'  id="app_status<?=$app_arr[$j]['id']?>"  class="app_Stat">
																</label>
															</td>
														<?php
														}
														
														?>


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
									<div class="card panel">
										<div  class="card-head collapsed">
											<header>No Results Found..</header>
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

				</div>
			</div>

		</div>
	</section>
</div>


<style>
label.app_select {
    color: #000;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    width: 100%;
}
</style>


<script>

$(document).ready(function(){
	var keys = [];
	$(".details").hide();
	
	$(".app_Stat").each(function(){
		
		var appId	=	$(this).closest('td').find("input.hid_app").val();
		
		if($.inArray(appId, keys)== -1) 
		{
			keys.push(appId);
			var mode	=	0;
			$("input[name*='app_status"+appId+"[]']").each(function(){
			   if($(this).attr('checked')!='checked')
			   {
				   mode=1;
			   }
			});
			if(mode==0)
			$('#'+appId).attr('checked',true);
		}
	});
	
	$(".app_all_Stat").change(function(){
		var app_id=$(this).attr('id');
		if($(this).attr('checked'))
		{
			var status	=	1;
		}
		else
			var status	=	0;
		
		$(".app_Stat").each(function(){
			if($(this).attr('id')=='app_status'+app_id)
			{
				if(status	==	1)
					$(this).attr('checked',true);
				else
					$(this).attr('checked',false);
				var userid	=	$(this).attr('userId');
				var appid	=	$(this).closest('td').find("input.hid_app").val();
				var accid	=	$(this).closest('td').find("input.hid_acc").val();
				setAccess(userid,appid,accid,status);
			}
		});
	});
	$(".app_Stat").change(function(){
		var userid	=	$(this).attr('userId');
		var appid	=	$(this).closest('td').find("input.hid_app").val();
		var accid	=	$(this).closest('td').find("input.hid_acc").val();
		if($(this).attr('checked'))
		{
			var status	=	1;
		}
		else
			var status	=	0;
		
		setAccess(userid,appid,accid,status);
		var mode	=	0;
			$("input[name*='app_status"+appid+"[]']").each(function(){
			   if($(this).attr('checked')!='checked')
			   {
				   mode=1;
			   }
			});
			if(mode==0)
				$('#'+appid).attr('checked',true);
			else
				$('#'+appid).attr('checked',false);
		
	});
	$('#input_search').on('keypress', function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) {
			e.preventDefault();
			var username = $("#input_search").val();
			window.location='access?search='+$(this).val();       
		}
	});	
});
function setAccess(userid,appid,accid,status)
{
	if(accid)
			var flag	=	"update";
		else
			var flag	=	"add";
	$.ajax({
				 url: 'ajax.php',
				 data: {  'mode':'accessdata','userid': userid,'appid': appid,'accid': accid,'flag': flag,'status': status },
				 type: "post",
				 datatype: 'json',
				 success: function(data){
					if(data) 
					{
						$('#acc_'+userid+appid).val(data);
					}
				  }
				  }); 
}
</script>



