<?php

namespace app\controllers;

use Yii;
use app\models\Domain;
use app\models\DomainSettings as Setting;
use app\models\DomainApps as Apps;
use app\models\DomainMap as Maps;
use app\models\search\DomainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DomainController implements the CRUD actions for Domain model.
 */
class DomainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Domain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DomainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Domain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Domain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
        $model = new Domain();
		$setting = new Setting();
		$apps = new Apps();
		$maps = new Maps();
        if (($model->load(Yii::$app->request->post())) && ($setting->load(Yii::$app->request->post()))) {
			
           $model->userid = Yii::$app->user->id;
		   
		   if($model->save()){
			   
			    if($setting->publicdomainNameLinkId == 1)
				{
					
				$setting->userid = $model->userid;
				$setting->skey = 'publicdomainNameLinkId';
				$setting->sval = $model->id;
				$setting->save(false);
				
				} else 
				{
					
			    $setting->userid = $model->userid;
				$setting->skey = 'publicdomainNameLinkId_key_'.$model->id;
				$setting->sval = $setting->publicdomainNameLinkId;
				$setting->save(false);
				}
				
				
				
				$al_heroku_common_app_name = Yii::$app->params['al_heroku_common_app_name'];
				$apps->userid = $model->userid;
				$apps->domainid = $model->id;
				$apps->appname = $al_heroku_common_app_name;
				$apps->applink = "https://".$al_heroku_common_app_name.".herokuapp.com";
				$apps->appdetails = 'NEW';
				$apps->status = 1;
				$apps->modifydate = date('Y-m-d');
				
				if($apps->save())
				{
					
					$domainMap = "";
					$maps->userid =  $model->userid;
					$maps->appid = $apps->id;
					$maps->mapname = $model->name;
					$maps->maplink = $model->name;
					$maps->mapdetails = serialize($domainMap);
					$maps->status = 1;
					$maps->modifydate = date('Y-m-d');
					$maps->save();
					
				
				}
		   
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', ['model' => $model,"setting" => $setting ]);
			}
			
        } else {
            return $this->render('create', ['model' => $model,"setting" => $setting ]);
        }
    }

    /**
     * Updates an existing Domain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$setting = Setting::find()->where(['sval'=>$id])->orWhere(['skey'=>"publicdomainNameLinkId_key_".$id])->one();
		
		if (($model->load(Yii::$app->request->post())) && ($setting->load(Yii::$app->request->post()))) {
			
			 $model->userid = Yii::$app->user->id;
			 
			  if($model->save()){
			   
			    if($setting->publicdomainNameLinkId == 1)
				{
					
				$setting->userid = $model->userid;
				$setting->skey = 'publicdomainNameLinkId';
				$setting->sval = $id;
				$setting->save(false);
				
				} else 
				{
					
			    $setting->userid = $model->userid;
				$setting->skey = 'publicdomainNameLinkId_key_'.$id;
				$setting->sval = $setting->publicdomainNameLinkId;
				$setting->save(false);
				}
				
				
				$apps = Apps::find()->where(['domainid'=>$id])->one();
				
				
				$al_heroku_common_app_name = Yii::$app->params['al_heroku_common_app_name'];
				$apps->userid = $model->userid;
				$apps->appname = $al_heroku_common_app_name;
				$apps->applink = "https://".$al_heroku_common_app_name.".herokuapp.com";
				$apps->appdetails = 'NEW';
				$apps->status = 1;
				$apps->modifydate = date('Y-m-d');
				
				if($apps->save())
				{
					$maps = Maps::find()->where(['appid'=>$apps->id])->one();
					$domainMap = "";
					$maps->userid =  $model->userid;
					$maps->mapname = $model->name;
					$maps->maplink = $model->name;
					$maps->mapdetails = serialize($domainMap);
					$maps->status = 1;
					$maps->modifydate = date('Y-m-d');
					$maps->save();
					
				
				}
		   
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', ['model' => $model,"setting" => $setting ]);
			}
        } else {
            return $this->render('update', [
                'model' => $model, 'setting' => $setting,
            ]);
        }
    }

    /**
     * Deletes an existing Domain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Domain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Domain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Domain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	 /**
     * Multiple Deletes an existing Blogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 
	
	 public function actionMultiDelete()
		{    
			$id = Yii::$app->request->post()['domain_id'];	
			if($id)
			{		
				 foreach($id as $tmp)
				 {					
					$domain = Domain::findOne($tmp);
					$domain->delete(); 
				 }
			}  			
		}
		
}
