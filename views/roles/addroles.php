<?php
use yii\helpers\Html;
use yii\grid\GridView;

$title = "Add New Role";
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
$csrf = Yii::$app->request->getCsrfToken();
$userData = Yii::$app->session->get('custUserData');
?>
<div class="user-profile-index">

<section>
<div class="section-body contain-lg">
<div id="compaign-setting">
    <form class="form" method="POST" action="/roles/add-role">
    <h2 class="text-primary"><?php echo $title;?></h2>
    <br>
    <input type="hidden" name="_csrf" value="<?php echo $csrf;?>">   	
    <div class="card-body">
    <p id="message" class="message"></p>
    <div class="form-group col-md-12">
    <div class="input-group col-md-6">
    <div class="input-group-content">
    <input type="text" name="Roles[rolename]" class="form-control" value="">   
    <label for="rolename">Rolename</label>
    </div>
    </div>
    </div><!--end .form-group -->
    <div class="form-group col-md-3">    
    <div><label for="rolename">Status</label></div>
    <select class="form-control " name="Roles[status]" id="rolestatus">
    <option value="active">active</option>
    <option value="inactive">inactive</option>
    </select>

    </div>
    <div class="form-group col-md-12">
    <div class="col-md-2" style="text-align: right;">
    <input id="cancelbtn" class="btn btn-primary roles-button" type="button" value="Cancel" data-url="roles/settings">
    </div>
    <div class="col-md-2" >
    <input class="btn btn-danger roles-button" type="submit" value="Submit" >
    </div>

    <div class="col-md-8">&nbsp;</div>
    </div>
    </div><!--end .card-body -->
    <input type="hidden" name="Roles[cdate]" value="<?php echo date('Y-m-d');?>">
    <input type="hidden" name="Roles[createdby]" value="<?php echo $userData['uid'];?>">
    <input type="hidden" name="Roles[default_access]" value="0">
    </form>
</div>
</div>
</section>
    
</div>
