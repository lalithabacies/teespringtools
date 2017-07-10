<?php

namespace app\controllers;

use Yii;

use app\models\AppList;
use app\models\search\AppListSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Session;
use app\components\AccessRule; //custom accessRules
use app\models\Storage;

/**
 * AppListController implements the CRUD actions for AppList model.
 */
class ApplistController extends Controller
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
                'only' => ['index', 'view', 'create', 'delete', 'update'], //only be applied to
                'rules' => [                    
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'delete', 'update'],
                        'roles' => ['admin'],
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
     * Lists all AppList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AppListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AppList model.
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
     * Creates a new AppList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AppList();
		$model->scenario = 'create_app';
        if ($model->load(Yii::$app->request->post())) {
			
				//save image here
				$model->image_link = UploadedFile::getInstance($model, 'image_link');
				
				if(!empty($model->image_link)) { 
					/* if(!$model->uploadImage())
						return; */
					
						$time = time();
						$model->image_link->saveAs(Yii::$app->params['web_appimg'].$time.$model->image_link);
                       
						//$tmp_filename = $model->image_link->tempName;
						
                        $bucket = Yii::$app->params['aws_bucket'];
                        $keyname = Yii::$app->params['aws_keyname_appimg'].preg_replace('/\s+/', '', $time.$model->image_link);
                        $path=\Yii::$app->basePath.'/web/'.Yii::$app->params['web_appimg'].$time.$model->image_link;
                        $file_ext =  pathinfo($model->image_link, PATHINFO_EXTENSION);
                        $filepath = $path;			
                        $s = new Storage();
                        $result = $s->upload($bucket,$keyname,$filepath);
                        $s3_filename = $result['ObjectURL'];  	
                        $model->image_link=$s3_filename;
						
								
				} 
					
					
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [
                'model' => $model,
            ]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AppList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$current_image = $model->image_link;
		
        if ($model->load(Yii::$app->request->post())) {
			
				$model->image_link = UploadedFile::getInstance($model, 'image_link');										
				if(!empty($model->image_link)){ 
					/* if(!$model->uploadImage())
						return; */
					
						
						$time = time();
						$model->image_link->saveAs(Yii::$app->params['web_appimg'].$time.$model->image_link);
                       
						//$tmp_filename = $model->image_link->tempName;
						
                        $bucket = Yii::$app->params['aws_bucket'];
                        $keyname = Yii::$app->params['aws_keyname_appimg'].preg_replace('/\s+/', '', $time.$model->image_link);
                        $path=\Yii::$app->basePath.'/web/'.Yii::$app->params['web_appimg'].$time.$model->image_link;
                        $file_ext =  pathinfo($model->image_link, PATHINFO_EXTENSION);
                        $filepath = $path;			
                        $s = new Storage();
                        $result = $s->upload($bucket,$keyname,$filepath);
                        $s3_filename = $result['ObjectURL'];  	
                        $model->image_link=$s3_filename;
						
				}
			 else
				{										
					$model->image_link = $current_image;				
				}
				
            if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [ 'model' => $model ]);
			}			
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AppList model.
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
     * Finds the AppList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AppList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
