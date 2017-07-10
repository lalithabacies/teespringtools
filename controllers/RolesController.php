<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\components\AccessRule; //custom accessRules

use app\models\Roles;
use app\models\RolesApp;
use app\models\UserRole;
use app\models\User;+
use yii\db\ActiveRecord;

class RolesController extends Controller
{    
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(), //custom accessRules
                ],
                'only' => ['index', 'settings', 'addrole', 'details', 'update'], //only be applied to
                'rules' => [                    
                    [
                        'allow' => true,
                        'actions' => ['index', 'settings', 'addrole', 'details', 'update'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    
    /* @Description:Landing Page for Roles
     * It will Display Default Role Settings
     * @Created: 27-June-2017
    */
    public function actionIndex()
    {        
        $roles = $this->getRoles();
        return $this->render('index',array('data'=>$roles));
        
    }
    
    /* @Description:Page for Roles setting
     * Display Role settings page (add new or edit role)
     * @Created: 27-June-2017
    */
    public function actionSettings()
    {
        $roles = $this->getRoles();
        return $this->render('settings',array('roles'=>$roles));
    }
    
    public function actionAddRole()
    {
        $model = new Roles();
        if (Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $model->load($post['Roles']);
            $model->rolename = $post['Roles']['rolename'];
            $model->cdate = $post['Roles']['cdate'];
            $model->createdby = $post['Roles']['createdby'];
            $model->status = $post['Roles']['status'];
            $model->default_access = $post['Roles']['default_access'];
            $model->save();
            $this->redirect(array('roles/settings'));
        } else {
            return $this->render('addroles',array('model' => $model));
        }
    }
    
    /*@Description:Display Relation between Apps & Roles   
    * @Created: 28-June-2017
    */
    public function actionDetails()
    {
        $roles = $this->getRoles();
        $model = new Roles();
        $data = $model->getAppWithRole();
        return $this->render('details',array('data'=>$data,'roles'=>$roles));
    }
    
    /*@Description:Edit Roles
    * @Created: 29-June-2017
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post(),'Roles') && $model->save()) {          
            $this->redirect(array('roles/settings'));
        } else {
            return $this->render('update',array('model' => $model));
        }
    }
    
    /**
    * Deletes an existing Role.    
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id){
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    
    /* @Description:Set User's Role (1:1)
     * It will update Individual user's Role
     * @Created: 30-June-2017
    */
    public function actionUserRoles($pno=0)
    {
        $roles = $this->getRoles();
        $model = new UserRole();
        $userRoles = $model->getUserRoles($pno,$limit=10);
		$noofuserroles=$model->getNoofUserRoles();
        return $this->render('userroles',array('userroles'=>$userRoles,'roles'=>$roles,'noofuserroles'=>$noofuserroles,'per_page'=>$limit));        
    }

    //Ajax Call
    public function actionUpdateDefaultRole()
    {
        if (Yii::$app->request->isAjax){
            if(Yii::$app->request->post('roleid')!==null){
                Roles::updateAll(['default_access' => 0]); 
                $id = Yii::$app->request->post('roleid');
                Roles::updateAll(['default_access' => 1], "id = $id");                 
                echo "success";
            } else{
                echo "error";
            }
        }
    }
    
    //Ajax Call
    public function actionSetAppRoles()
    {
        if (Yii::$app->request->isAjax){
            if(Yii::$app->request->post('roleid')!==null){
                $appid = Yii::$app->request->post('appid');
                $roleappid = Yii::$app->request->post('roleappid');
                $roleid = Yii::$app->request->post('roleid');
                $status = Yii::$app->request->post('status');
                $mode = Yii::$app->request->post('mode');
                if ($mode=="update"){
                    $roleApp = RolesApp::findOne($roleappid);
                    $roleApp->status = $status;
                    $roleApp->save();
                } else{
                    $roleApp = new RolesApp();
                    $roleApp->roleid = $roleid;
                    $roleApp->appid = $appid;
                    $roleApp->status = 1;
                    $roleApp->save();
                }
                echo "success";
            } else{
                echo "error";
            }
        }
    }
    
    //Ajax Call
    public function actionUpdateUserRole()
    {
        if (Yii::$app->request->isAjax){
            if(Yii::$app->request->post('roleid')!==null){
                $userroleid = Yii::$app->request->post('userroleid');
                $roleid = Yii::$app->request->post('roleid');                
                UserRole::updateAll(['roleid' => $roleid], "id = $userroleid");
                echo "success";
            } else{
                echo "error";
            }
        }
    }

    //Ajax Call
    public function actionAddUserRole()
    {
        if (Yii::$app->request->isAjax){
            if(Yii::$app->request->post('roleid')!==null){
                $model = new UserRole();
                $model->roleid = Yii::$app->request->post('roleid');
                $model->userid = Yii::$app->request->post('userid');
                $model->save();
                echo "success";
            } else{
                echo "error";
            }
        }
    }
    
    private function getRoles()
    {
        $array[] = 'customRole';
        $roles = Roles::find()->where(['not in','rolename',$array])
        ->orderBy(['(id)' => SORT_DESC])->asArray()->all();
        return $roles;
    }
    
    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

?>