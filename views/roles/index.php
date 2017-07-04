<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Default User Role';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

<h1><?= Html::encode($this->title) ?></h1>   

<section>
    <div align="center">
    <table class="col-lg-12 table no-margin">
    <thead>
    <tr>
    <th colspan="2">Roles</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($data)>0){
        foreach($data as $keys=>$values){
            $id = $values['id'];
            $checked='';	
            $checked = ($values['default_access']==1) ? 'checked=checked' : '';				
    ?>              
        <tr>
        <td><?php echo $values['rolename'];?></td>
        <td style="text-align:center;">
        <label class="radio radio-styled">
            <input type="radio" class="role_Stat" name="role_status[]" value="1" data-roleid="<?php echo $id;?>" <?=$checked?> onclick="setdefaultrole(this)">
            <span></span>
        </label>
        </td>
        </tr>
    <?php 
    }
       }   
    ?>       
    </tbody>
    </table>
    </div>
</section>    
      
</div>
