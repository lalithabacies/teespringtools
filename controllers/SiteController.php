<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\Roles;
use app\models\UserProfile;
use app\models\AppList;
use app\models\TshirtUsers;
use app\models\TshirtAccess;
use app\models\Changepwd;
use app\models\UserRole;
use app\models\PasswordResetRequestForm;


use yii\web\Session;
use app\components\AccessRule;

class SiteController extends Controller
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
                'only' => ['access'], //only be applied to
                'rules' => [                    
                    [
                        'allow' => true,
                        'actions' => ['access'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
			
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ], 
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /* @Description:Landing Page Before Login
     * If user seesion it will display this page else Home.    
     * @Created: 23-June-2017
    */
    public function actionIndex()
    { 
        if(Yii::$app->user->isGuest){
		    $this->layout = 'beforeLogin';
            return $this->render('login');
		} else{
         // return $this->render('index');
			return $this->redirect(['site/home']);
        }
    }

    
    public function actionLogin()
    {
        if (Yii::$app->request->isAjax) {
            if(Yii::$app->request->post('username')!==null){
                $params = array();
                $params['username'] = Yii::$app->request->post('username');
                $params['password'] = Yii::$app->request->post('userpass');
                $params['_csrf'] = Yii::$app->request->post('_csrf');
                $params['rememberme'] = True;            
                $model = new LoginForm();
                if ($model->setUserLogin($params)){                                     
                    echo "success";
                } else{
                    echo "error";
                }
            }
        } else{
            $this->redirect(array('site/'));
        }
    }
	
	public function actionAccess($pno='0',$search=''){
		

		$access=AppList::find()->all();
		$users_query =TshirtUsers::find();
		isset($search)?$users_query_where=$users_query->where(["like","username",$search]):'';
		$users=$users_query_where->offset($pno)->limit(30)->all();
		
		$accessUser = TshirtAccess::find()->all();
		return $this->render('access',[
		    'app_arr'=>$access,
			'users' =>$users,
			'acc_arr'=>$accessUser,
			'total_cnt'=>$users_query_where->count()
		]);
	}
	
	public function actionAjax()
	{
		$post = Yii::$app->request->post();
		$success			=	"";	
		$params['userid']	= 	$post["userid"];
		$params['appid'] 	=	$post["appid"];
		$params['status']	=	$post["status"];
		$params['id']		=	$post["accid"];
		$customaccess	 	=	TshirtAccess::getCustomRoleAccess($params);
		if(empty($customaccess))
			$params['roleid']=null;
		else
			$params['roleid']=$customaccess[0]['role_id'];
		$flag				=	$post["flag"];
		if($post["accid"] && $flag=='update')	
		{
			$updateaccess	 =	TshirtAccess::updateAccess($params);
			if($updateaccess==1)
			{
				$success	=	$params['id'];
			}
		}
		else
		{
			$addaccess	 =	TshirtAccess::addAccess($params);
			if($addaccess)
			{
				$success	=	$addaccess;
			}
		}
		echo $success;exit;
	}
    public function actionLogout()
    {        
        Yii::$app->user->logout();
        $session = Yii::$app->session;
        $session->close();
        $session->destroy();
        return $this->goHome();
    }

    public function actionHome()
    {        
        if(Yii::$app->user->isGuest){
		    $this->layout = 'beforeLogin';
            return $this->render('login');
		} else{
            $userIdentity = Yii::$app->user->identity;
		    $checkdata = AppList::find()->all();
		    return $this->render('dashboard',[ 'checkdata' => $checkdata ]);
        }        
    }     

	
	   /**
     * Sign up action.
     *
     * @return string
     */
    public function actionSignup()
    {		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		$model = new UserProfile();
		$role = new Roles();
		
	if ($model->load(Yii::$app->request->post()) && $model->validate() && $role->load(Yii::$app->request->post())) {
				
            if($model->save())
            {      
				$userrole = new UserRole();
				$userrole->roleid = $role->id;
				$userrole->userid = $model->id;
				$userrole->save();	        
				Yii::$app->session->setFlash('RegisterFormSubmitted');
				return $this->goBack();				
            }
               
        }
		$this->layout = "beforeLogin";
        return $this->render('signup', ['model' => $model,'role' => $role]);
    }
    
	
    /**
     * Changing password
     * @return type
     */

    
	public function actionChangepwd()
	{
		
		if(Yii::$app->user->isGuest){ 	
			return $this->redirect(['site/index']);
		}
		
		$model = new Changepwd();
		$user   = UserProfile::findOne(Yii::$app->user->id);
		if ($model->load(Yii::$app->request->post())) {		
				// form inputs are valid, do something here
			
                    $user->password = $model->newpassword;
                    
                    if($user->save(false))
                    {						
                        Yii::$app->session->setFlash('change_pwd_success');					
                    } else 
                    {
                        Yii::$app->session->setFlash('change_pwd_error');
                    }
				
				return $this->refresh();			 			
		}

		return $this->render('changepassword', [
			'model' => $model,
		]);
	}

	public function actionRequestPasswordReset()
    {	
		if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post())) {
					
             if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['login']);
            } else { 
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
				
            }	 	   
        } 
		//$this->layout = "beforeLogin";
        return $this->render('requestPasswordResetToken', ['model' => $model]);
    }
	 
	 
	public function actionTestMail(){
		Yii::$app->mailer->compose()
			->setTo('arivazhagan@abacies.com')
			->setFrom(['admin@simplywishes.com' => 'Dency G B'])
			->setSubject('Test mail from simplywishes')
			->setTextBody('Regards')
			->send();		
	}
	
}

?>