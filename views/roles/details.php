<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Role Details';
$this->params['breadcrumbs'][] = $this->title;

$roleArray = array();
?>
<div>

<h1 class="text-primary"><?php echo Html::encode($this->title);?></h1>  

<section>
<table class="col-lg-12 table no-margin">
    <thead>			 
    <tr>
    <th>Apps</th>
    <?php
    if(count($roles)>0){
        //Create an Array with RoleID & RoleName from Roles Table;
        foreach($roles as $keys=>$values){
            $roleArray[$values['id']] = $values['rolename']                    
    ?>
        <th><?php echo $values['rolename']; ?></th>
    <?php
    } }    
    ?>
    </tr>
    </thead>
    <tbody>
    <?php if(count($data)>0){ 
        //data from roles-app Table, Render Apps Column - 1st Loop;
        foreach($data as $keys=>$values)
        {
            $appid = $values['appid'];
    ?>           
        <tr>
        <td><?php echo $values['appname']; ?></td>
        <?php 
            $roles = $values['approle']; 
            //approle contains roles_app Table id,status for Apps w.r.t roles;
            $appRoleData = array();
            if(count($roles)){
            foreach($roles as $k=>$v){                
               $appRoleData[$v['roleid']] = array('roleappid'=>$v['roleappid'],
               'status'=>$v['status']);
            }
            }
            //Render the Role Check Boxes from Roles Table - 2nd Loop;
            foreach($roleArray as $rolekey=>$roleval){
                $checked = '';
                $roleid = $rolekey;
                $roleAppid = 0;
                //For New Apps appRoleData will be NULL, i.e no entry in roles_app Table;
                if(isset($appRoleData[$rolekey]) && $appRoleData[$rolekey]['status']==1){
                   $checked = "checked='checked'";                   
                   $roleAppid = $appRoleData[$rolekey]['roleappid'];
                }
            ?>
                <td>
                <label class="checkbox-inline checkbox-styled">
                <input type="checkbox" data-roleid="<?php echo $roleid;?>" value='1' name='role_status[]' <?php echo $checked;?> 
                data-roleappid="<?php echo $roleAppid;?>" data-appid="<?php echo $appid;?>" onclick="setapproles(this)">
                </label>
                </td>
    <?php
            }
            unset($appRoleData);            
        }
    } 
    unset($roleArray);
    ?>
    </tbody>
</table>
</section>   
</div>

<?php
/*
approle = 
Array ( [0] => Array ( [roleappid] => 9 [roleid] => 5 [status] => 1 ) 
[1] => Array ( [roleappid] => 4 [roleid] => 2 [status] => 0 ) 
 ) 
 */
 ?>