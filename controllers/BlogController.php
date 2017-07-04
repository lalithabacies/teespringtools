<?php

namespace app\controllers;

use Yii;
use app\models\Blogs;
use app\models\BlogsComments;
use app\models\search\BlogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blogs model.
 */
class BlogController extends Controller
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
     * Lists all Blogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	
	public function actionIndexBlog()
    {
        $searchModel = new BlogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index_blog', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single Blogs model.
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
     * Creates a new Blogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blogs();
		$model->scenario = 'create_blog';
        if ($model->load(Yii::$app->request->post())) {
			
			//save image here
				$model->blogimage = UploadedFile::getInstance($model, 'blogimage');
				
				if(!empty($model->blogimage)) { 
					if(!$model->uploadImage())
						return;
								
				} 
				$model->createddate = $model->modifieddate = date('Y-m-d H:i:s');
				$model->createdby = $model->modifiedby = Yii::$app->user->id;
			if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', ['model' => $model,]);
			}
          
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Blogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$current_image = $model->blogimage;
        if ($model->load(Yii::$app->request->post())) {
			
            $model->blogimage = UploadedFile::getInstance($model, 'blogimage');										
				if(!empty($model->blogimage)){ 
					if(!$model->uploadImage())
						return;
				}
			 else
				{										
					$model->blogimage = $current_image;				
				}
				
				$model->modifieddate = date('Y-m-d H:i:s');
				$model->modifiedby = Yii::$app->user->id;
				
            if($model->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', [ 'model' => $model ]);
			}			
			
        } else {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Blogs model.
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
     * Finds the Blogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blogs::findOne($id)) !== null) {
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
			$blog_id = Yii::$app->request->post()['blog_id'];	
			if($blog_id)
			{		
				 foreach($blog_id as $tmp)
				 {					
					$blog = Blogs::findOne($tmp);
					$blog->delete(); 
				 }
			}  			
		}
		
	/**
     * Displays a single Blogs model and Blogs Comments.
     * @param integer $id
     * @return mixed
     */
    public function actionViewBlog($id)
    {		
        return $this->render('details', [
            'model' => $this->findModel($id),
            'blogcomments' => BlogsComments::find()->where(["blog_id"=>$id])->all(),
			'newblogcmt' => new BlogsComments()
        ]);
    }



/**
     * Displays a single Add New Blogs Comments.
     * @param integer $id
     * @return mixed
     */
    public function actionAddBlogComments()
    {		
         $model = new BlogsComments();
         if($model->load(Yii::$app->request->post()))
		 {			
		
			   $model->createdby = \Yii::$app->user->id;
			   $model->status = 1;
			   $model->createddate = date('Y-m-d H:i:s');
				
			   if($model->save())
			   {				
				 return $this->redirect(['blog/view-blog?id='.$model->blog_id]);
			   }else{				   
				   Yii::$app->session->setFlash('error_comments');
				   return $this->redirect(['blog/view-blog?id='.$model->blog_id]);
			   }
		 }
		 
    }
	
	
}
