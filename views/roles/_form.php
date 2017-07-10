<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$items = array("active"=>"active","inactive"=>"inactive");
$options = ['style'=>'width:15% !important', $model->status=>['selected'=> true]];
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'rolename')->textInput(['maxlength' => true]) ?>
	
    <? //= Html::activeDropDownList($model, 'status',$items,$options) ?>    
    <?php //echo $form->field($model, 'status')->dropDownList($items,$options); ?>
    
    <div class="form-group field-roles-rolename required">
    <label for="roles-rolename" class="control-label">Status</label>
    <select class="form-control" style="width:15% !important" name="Roles[status]" id="roles-status">  
    <?php
    if($model)
    {
        $mstatus = trim($model->status);
        foreach($items as $key=>$values)
        {
            if(strcmp($mstatus, $key)===0){
                echo "<option selected='selected' value='".$key."'>".$values."</option>";
            } else{
                echo "<option value='".$key."'>".$values."</option>";
            }
        }
    }
    ?> 
    </select>    
    <div class="help-block"></div>
    </div>
    <?php echo $form->field($model, 'cdate')->hiddenInput()->label(false); ?>    
    <div>
    
    </div>    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>