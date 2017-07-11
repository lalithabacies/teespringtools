<?php

namespace app\controllers;

use Yii;
use app\models\HerokuTickets;
use app\models\AppList;
use app\models\TicketsMessage;
use app\models\TshirtAccess;
use app\models\search\HerokuTicketsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Storage;
use yii\filters\AccessControl;
use yii\web\Session;
use app\components\AccessRule;

//use app\models\TicketsMessage;
/**
 * TicketController implements the CRUD actions for HerokuTickets model.
 */
class TicketController extends Controller
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
                'only' => ['create','view', 'delete', 'update','ticket-display'], //only be applied to
                'rules' => [                    
                    [
                        'allow' => true,
                        'actions' => [ 'view', 'delete', 'update','ticket-display','index'],
                        'roles' => ['admin'],
                    ],
					[
                        'allow' => false,
                        'actions' => ['create'],
                        'roles' => ['admin'],
                    ],
					[
                    'allow' => false,
					'actions' => ['view', 'delete', 'update'],
                    'roles' => ['@'],
					],
					[
                        'allow' => true,
                        'actions' => ['create','ticket-display','index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HerokuTickets models.
     * @return mixed
     */
    /* public function actionIndex($id="")
    {
        $searchModel = new HerokuTicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model = AppList::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
        ]);
    } */

	
	/**
     * Lists all HerokuTickets models.
     * @return mixed
     */
    public function actionIndex($id="")
    {
		$extraprams = $id;
        $searchModel = new HerokuTicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$extraprams);

		$session = Yii::$app->session;
        if(!empty($session['isAdmin'])){ 
			$model = AppList::find()->orderBy('name ASC')->all();
		} 
		else if(Yii::$app->user->id)
		{
			$model = TshirtAccess::find()->joinWith('userAppList')->where(['userid'=>Yii::$app->user->id,'status'=>1])->orderBy('name ASC')->all();
		}
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
			'appid' => $extraprams,
        ]);
    }

	
    /**
     * Displays a single HerokuTickets model.
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
     * Creates a new HerokuTickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 
     public function actionCreate()
    {
        $model = new HerokuTickets();
		
		$session = Yii::$app->session;
        if(!empty($session['isAdmin'])){ 
			$applist = AppList::find()->orderBy('name ASC')->all();
		} 
		else if(Yii::$app->user->id)
		{
			$applist = TshirtAccess::find()->joinWith('userAppList')->where(['userid'=>Yii::$app->user->id,'status'=>1])->orderBy('name ASC')->all();
		}
		
		$model->scenario = 'create_ticket';
        if ($model->load(Yii::$app->request->post())) {
				
				$model->userid = Yii::$app->user->id;
				$model->status = 1;
			//save image here
				$model->image = UploadedFile::getInstance($model, 'image');
				
				if(!empty($model->image)) { 
					/* if(!$model->uploadImage())
						return; */
					
						$time = time();
						$model->image->saveAs(Yii::$app->params['web_ticketimg'].$time.$model->image);
                       
						//$tmp_filename = $model->image->tempName;
						
                        $bucket = Yii::$app->params['aws_bucket'];
                        $keyname = Yii::$app->params['aws_keyname_ticketimg'].preg_replace('/\s+/', '', $time.$model->image);
                        $path=\Yii::$app->basePath.'/web/'.Yii::$app->params['web_ticketimg'].$time.$model->image;
                        $file_ext =  pathinfo($model->image, PATHINFO_EXTENSION);
                        $filepath = $path;			
                        $s = new Storage();
                        $result = $s->upload($bucket,$keyname,$filepath);
                        $s3_filename = $result['ObjectURL'];  	
                        $model->image=$s3_filename;
													
				} 
				
			if($model->save()){
				return $this->redirect(['index']);
				 
				//return $this->redirect(['view', 'id' => $model->id]);
			} else 
			{
				return $this->render('create', ['model' => $model,'applist'=>$applist]);
			}				
           
        } else {
            return $this->render('create', ['model' => $model,'applist'=>$applist ]);
        }
    } 

    /**
     * Updates an existing HerokuTickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$session = Yii::$app->session;
        if(!empty($session['isAdmin'])){ 
			$applist = AppList::find()->orderBy('name ASC')->all();
		} 
		else if(Yii::$app->user->id)
		{
			$applist = TshirtAccess::find()->joinWith('userAppList')->where(['userid'=>Yii::$app->user->id,'status'=>1])->orderBy('name ASC')->all();
		}
		
		$current_image = $model->image;
        if ($model->load(Yii::$app->request->post())) {
			
			//save image here
				$model->image = UploadedFile::getInstance($model, 'image');
				
				if(!empty($model->image)) { 
					/* if(!$model->uploadImage())
						return; */
					
						$time = time();
						$model->image->saveAs(Yii::$app->params['web_ticketimg'].$time.$model->image);
                       
						//$tmp_filename = $model->image->tempName;
						
                        $bucket = Yii::$app->params['aws_bucket'];
                        $keyname = Yii::$app->params['aws_keyname_ticketimg'].preg_replace('/\s+/', '', $time.$model->image);
                        $path=\Yii::$app->basePath.'/web/'.Yii::$app->params['web_ticketimg'].$time.$model->image;
                        $file_ext =  pathinfo($model->image, PATHINFO_EXTENSION);
                        $filepath = $path;			
                        $s = new Storage();
                        $result = $s->upload($bucket,$keyname,$filepath);
                        $s3_filename = $result['ObjectURL'];  	
                        $model->image=$s3_filename;
													
				}
				else
				{										
					$model->image = $current_image;				
				}				
				
			if($model->save()){
				return $this->redirect(['index']);
			} else {
				return $this->render('update', ['model' => $model,'applist'=>$applist]);
			}				
            
        } else {
            return $this->render('update', ['model' => $model,'applist'=>$applist]);
        }
    }

    /**
     * Deletes an existing HerokuTickets model.
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
     * Finds the HerokuTickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HerokuTickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HerokuTickets::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	/**
     * Updates an existing HerokuTickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionTicketDisplay($id)
    {
		$model1 = new TicketsMessage();
        $model = TicketsMessage::find()->where(['ticketid'=>$id])->all();
        $ticket = $this->findModel($id);
		
         if (($model1->load(Yii::$app->request->post())) && ($ticket->load(Yii::$app->request->post())))  {
			
				$model1->adminid = Yii::$app->user->id;
				$model1->updated_date =  date('Y-m-d H:i:s');
				
			//save image here
			/* 	$model1->attachment = UploadedFile::getInstance($model1, 'attachment');
				
				if(!empty($model1->attachment)) { 				
					if(!$model1->uploadImage())
						return;								
				}  */
				
				$model1->attachment = UploadedFile::getInstance($model1, 'attachment');
				
				if(!empty($model1->attachment)) { 
					/* if(!$model1->uploadImage())
						return; */
					
						$time = time();
						$model1->attachment->saveAs(Yii::$app->params['web_ticketimg'].$time.$model1->attachment);
                       
						//$tmp_filename = $model1->attachment->tempName;
						
                        $bucket = Yii::$app->params['aws_bucket'];
                        $keyname = Yii::$app->params['aws_keyname_ticketimg'].preg_replace('/\s+/', '', $time.$model1->attachment);
                        $path=\Yii::$app->basePath.'/web/'.Yii::$app->params['web_ticketimg'].$time.$model1->attachment;
                        $file_ext =  pathinfo($model1->attachment, PATHINFO_EXTENSION);
                        $filepath = $path;			
                        $s = new Storage();
                        $result = $s->upload($bucket,$keyname,$filepath);
                        $s3_filename = $result['ObjectURL'];  	
                        $model1->attachment=$s3_filename;
													
				} 
				
				
			  
			if($model1->save()){					
				  $ticket->save();				  
				  return $this->redirect(['index']);
			} 
			else{				
				 return $this->render('ticketdisplay', ['model' => $model,'model1' => $model1,'ticket' => $ticket]);
			}
        } else { 
            return $this->render('ticketdisplay', ['model' => $model,'model1' => $model1,'ticket' => $ticket,]);
        }
    }
 
	
}
