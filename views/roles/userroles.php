<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'User Roles';
$this->params['breadcrumbs'][] = $this->title;

$error = false;
$roleArray = array();
if(count($roles)>0){
    foreach($roles as $key=>$values){
        $roleArray[$values['id']] = $values['rolename'];    
    }
}

$total_page	= ceil($noofuserroles/$per_page);
$page_no    = isset($_GET['pno'])?$_GET['pno']:0;
$pdata		='';
$start		= ($page_no>$per_page)?($page_no-$per_page):1;
$total_page	= (($start+$per_page)>$total_page)?$total_page:(($page_no+$per_page)>$total_page)?$total_page:($page_no+$per_page);
?>
<div class="user-profile-index">

<h1><?= Html::encode($this->title) ?></h1>

<!-- BEGIN SEARCH RESULTS PAGING -->
		<?php
		if($total_page>1)
		{
			?>
			<div class="text-center">
				<ul class="pagination">
					<?php
					if($page_no > 1)
					{
						?>
						<li><?=Html::a('«',['user-roles','pno'=>($page_no-1)])?></li>
						<?php
					}	
					for($p=$start;$p<=$total_page;$p++)
					{
						$class=(($p-1)==$page_no)?"class='active'":'';
						?>
						<li <?=$class ?>><?=Html::a($p,['user-roles','pno'=>($p-1)])?></li>
						<?php
					}
					if($page_no < $total_page)
					{
						?>
						<li><?=Html::a('»',['user-roles','pno'=>($page_no+1)])?></li>
						<?php
					}
					?>
				</ul>
			</div><!--end .text-center -->
		<?php
		}
		?>

<section>

    <table>
    <thead>
    <tr>
    <th>Name</th>
    <th>Status</th>
    </tr>
    </thead>
    <tbody id="demoajax" cellspacing="0">    
    <?php if(count($userroles)>0){
        $userRoleid = 0;
        $uroleid = 0;
        foreach($userroles as $keys=>$values){
            $userRoleid = $values['userroleid'];
            $uroleid = $values['roleid'];
    ?>
    <tr>    
    <td><?php echo $values['username']; ?></td>    
    <td>    
    <select class='rolechange' data-userid="<?php echo $values['id']; ?>"
    data-userroleid="<?php echo $userRoleid;?>" onchange="setuserrole(this);">
    <option value=''>--Select--</option>   
    <?php if(count($roleArray)>0){
    foreach($roleArray as $id=>$value){
        $selected = ($uroleid==$id) ? "selected='selected'" : '';      
        $str = "<option value='".$id."' ".$selected.">".$value."</option>" ;
        echo $str;                
    }}
    ?>
    </select>
    </td>
    </tr>    
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <?php }
    unset($roleArray); 
    } ?>
    </tbody>	
    </table>

</section>    

    
</div>
