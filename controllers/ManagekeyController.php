<?php

namespace app\controllers;

use Yii;
use app\models\ManageKey;
use app\models\search\ManageKeySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ManageKeyController implements the CRUD actions for ManageKey model.
 */
class ManagekeyController extends Controller
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
     * Lists all ManageKey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManageKeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManageKey model.
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
     * Creates a new ManageKey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ManageKey();
		
        if ($model->load(Yii::$app->request->post())) {
			
			$model->created_date  = date('Y-m-d H:i:s');	
			$model->status  = 1;	
			$model->encrypted_data  = 1;	
			
			if($model->save(false))
			{
				$model->encrypted_data = base64_encode($model->id) ;
				$model->save(false);
				return $this->redirect(['index']);
			}
			else {
				
				return $this->render('create', ['model' => $model]);
			}
		
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ManageKey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          if($model->save(false))
			{
				$model->encrypted_data = base64_encode($model->id) ;
				$model->save(false);
				return $this->redirect(['index']);
			}
			else {
				
				return $this->render('create', ['model' => $model]);
			}
			
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ManageKey model.
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
     * Finds the ManageKey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManageKey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManageKey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
