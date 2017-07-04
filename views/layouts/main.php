<?php
//*** This Layout is used After Login ***
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;

use app\assets\AppAsset;
AppAsset::register($this);

/* use app\assets\AppAssetdefault;
AppAssetdefault::register($this); */

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
<body>
<?php $this->beginBody() ?>


	<!-- BEGIN HEADER-->
	<header id="header" >
		<div class="headerbar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="headerbar-left">
				<ul class="header-nav header-nav-options">
					<li class="header-nav-brand" >
						<div class="brand-holder">
							<a href="<?= Url::to(["site/index"]); ?>">
								<span class="text-lg text-bold text-primary">Teespring</span>
							</a>
						</div>
					</li>
					<?php if(!Yii::$app->user->isGuest)  { ?>
					<li>
						<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
							<i class="fa fa-bars"></i>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
		<?php if(!Yii::$app->user->isGuest){ ?>
			<div class="headerbar-right">
				
				<ul class="header-nav header-nav-profile">
						<li class="dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">							
							<span class="profile-info">
								<?php echo \Yii::$app->user->id; ?>			
							</span>
						</a>
						<ul class="dropdown-menu animation-dock">
							<?php if(!Yii::$app->user->isGuest)  { ?>
							<li><a href="<?= Url::to(["user/my-profile"]); ?>">My profile</a></li>							
							<?php } ?>
							<li>
						
								
							</li>
						</ul><!--end .dropdown-menu -->
					</li><!--end .dropdown -->
				</ul><!--end .header-nav-profile -->
			</div><!--end #header-navbar-collapse -->
		<?php } ?>
		</div>
	</header>
	<!-- END HEADER-->

	<!-- BEGIN BASE-->
	<div id="base">
	
	<!-- BEGIN CONTENT-->
				<div id="content">
					<section>
						<div class="section-body">
			
							<?= $content ?>
							
						</div><!--end .section-body -->
					</section>
				</div><!--end #content-->
				<!-- END CONTENT -->
				
		<!-- Left Side Menu Bar Begin Separate File  -->
	<?php if(!Yii::$app->user->isGuest) { 
			
			echo \Yii::$app->view->renderFile('@app/views/layouts/leftsidemenu.php'); 
		 } ?>	
		<!-- Left Side Menu Bar End Separate File -->
		
	</div><!--end #base-->
	<!-- END BASE -->


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
