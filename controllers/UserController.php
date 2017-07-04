<?php

namespace app\controllers;

use Yii;
use app\models\UserProfile;
use app\models\TrackUsers;
use app\models\search\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for UserProfile model.
 */
class UserController extends Controller
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
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfile model.
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
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserProfile model.
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
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	 public function actionEditMyProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['my-profile']);
        } else {
            return $this->render('editmyprofile', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionMyProfile()
    {
        $model = $this->findModel(Yii::$app->user->id);		
		return $this->render('myprofile', [
                'model' => $model,
            ]);
      
    }
	
	
	/**
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionUserLog()
    {		
        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->searchUserLog(Yii::$app->request->queryParams);

        return $this->render('userlog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	
	public function actionLogfunction()
	{
		$model = new UserProfile();
		$logdetails=$model->getBrowser();
		
		$model2 = new TrackUsers();
		$userid = Yii::$app->user->id;
		//$userid = 1;
		
		
		$model3 = TrackUsers::find()->where(["userid"=>$userid,"ip_address"=>$logdetails['ipaddress'],"location"=>$logdetails['location'],"browser"=>$logdetails['browser'],"os"=>$logdetails['os']])->one();
		
		if(!empty($model3))
		{			
			$model3['created_date'] = date('Y-m-d H:i:s');
			
			if ($model3->update(false)){
				return "success";
			} else {
				return "failed";
			}
			
		} else 
		{
			$model2['userid'] = $userid;
			$model2['ip_address'] = $logdetails['ipaddress'];
			$model2['location'] = $logdetails['location'];
			$model2['browser'] = $logdetails['browser'];
			$model2['os'] = $logdetails['os'];
			$model2['created_date'] = date('Y-m-d H:i:s');
		
			if ($model2->save(false)){
				return "success";
			} else {
				return "failed";
			}
		}
	}
	
}
