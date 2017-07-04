<?php

namespace app\controllers;

use Yii;
use app\models\HerokuTickets;
use app\models\AppList;
use app\models\TicketsMessage;
use app\models\search\HerokuTicketsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
		$model = AppList::find()->all();
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
	 
 /*    public function actionCreate()
    {
        $model = new HerokuTickets();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    } */

    /**
     * Updates an existing HerokuTickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			
			//save image here
				$model->image = UploadedFile::getInstance($model, 'image');
				
				if(!empty($model->image)) { 
					if(!$model->uploadImage())
						return;								
				} 
				
			if($model->save()){
				
			} else {
			
			}			
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
				$model1->attachment = UploadedFile::getInstance($model1, 'attachment');
				
				if(!empty($model1->attachment)) { 				
					if(!$model1->uploadImage())
						return;								
				} 
			  
			if($model1->save()){
					
				  $ticket->save();
				  
				  return $this->redirect(['index']);
			} else{				
				 return $this->render('ticketdisplay', ['model' => $model,'model1' => $model1,'ticket' => $ticket]);
			}
        } else { 
            return $this->render('ticketdisplay', [
                'model' => $model,       
                'model1' => $model1,       
                'ticket' => $ticket,       
            ]);
        }
    }
 
	
}
