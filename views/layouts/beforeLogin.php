<?php
//*** This Layout is used Before Login ***
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;

use app\assets\AppAsset;
AppAsset::register($this);

use yii\helpers\Url;
$baseUrl = Url::home(true);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="menubar-hoverable header-fixed menubar-pin login_page">
<?php $this->beginBody() ?>

<!--<div class="bpopup" id="gLogout">
    <div class="popup_title">Successfully Logged Out
    <span class="close_btn close_popup_btn"></span>
    </div>		
    <div class="popup_content">	
    <p style="text-align:center;">	
    <a href="http://localhost/tshirtbomb/">Click Here To Login Again</a>
    </p>
    </div>			
</div>-->
			
<!-- BEGIN HEADER-->
<header id="header" >
<div class="headerbar container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="headerbar-left">
<ul class="header-nav header-nav-options">
<li class="header-nav-brand" >
    <div class="brand-holder">
        <a href="#">               
            <h2 style="color:white !important" >Teespring</h2>
        </a>
    </div>
</li>    
</ul>
</div>
</div>
</header>

<div id="content">
    
    <?= $content ?>

</div>

<footer class="footer container-fluid">
<div class="container">
    <p class="pull-left">&copy;<?php echo date('Y'); ?> Teespring.</p> 
</div>
</footer>

<script>
var _teespring_param = {
   baseUrl :'<?php echo $baseUrl; ?>',
   csrftoken : '<?php echo Yii::$app->request->getCsrfToken(); ?>',
}
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
