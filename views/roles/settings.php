<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;

$error = false;
?>
<div class="user-profile-index">

<!--<h1><?= Html::encode($this->title) ?></h1>-->

<section>
<div class="section-body contain-lg">&nbsp;
    <div style="float:right;">
        <button class="btn btn-primary btn-lg" 
        type="button"  onClick="redirect();">
        Add New Role
        </button>
        <input type="hidden" data-url="roles/add-role" id="cltaction">
    </div>   
    <div class="row">
    <div class="col-md-12">
        <div class="col-md-12" style="margin-bottom: 10px;">
        <h1 class="text-primary">Roles</h1>
        </div>

        <div class="card-body tab-content">&nbsp;
        <div  class="tab-pane  <?php if(!$error){?> active <?php } ?>">	
        <div class="col-md-12">
        <?php
        if(count($roles)>0)
        {
            //$remove = base64_encode('remove');
            //$update = base64_encode('update');												  
        ?>
            <table class="table no-margin">
            <thead>
            <tr>
            <th class="col=md-6">Role Name</th>
            <th class="col-md-2">Status</th>
            <th class="col-md-2">&nbsp;</th>
            </tr>
            </thead>

            <div id="accordion0" class="panel-group">
            <tbody>
            <?php
            foreach($roles as $keys=>$values)
            {
                //$encid	=	base64_encode($allroles[$i]['id']);
                $id = $values['id'];                
            ?>

            <tr>
            <td><?php echo $values['rolename']; ?></td>
            <td><?php echo $values['status']; ?></td>
            <td>
                <a class="btn btn-icon-toggle" title="Update" href="/roles/update?id=<?php echo $id;?>">  
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a data-method="post" class="btn btn-icon-toggle" data-confirm="Are you sure you want to delete this item?" title="Delete" href="/roles/delete?id=<?php echo $id;?>">
                    <i class="fa fa-trash"></i>
                </a>            
            </td>
            </tr>
        <?php }  ?> 
            </tbody>
            </div><!--end .panel-group -->											
            </table>
        <?php
        } else {
        ?>
            <div class="card panel">
            <div class="card-head collapsed">
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
</section>    

    
</div>
