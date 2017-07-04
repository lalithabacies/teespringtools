<?php
$this->title =  Yii::$app->params['sitetitle'];
?>
<div class="main_page container">

<section class="caption col-sm-8 col-md-8">
<h2>Welcome to</h2>
<h1>Teespring Tools</h1>
<h4>Teespring is a platform that makes it easy for anyone to create and 
sell high quality product with no cost or risk. Teespring Tools is a 
suite of tools that will make your selling tasks easier and quicker to get done.</h4>
</section>

<section class="section-account col-sm-4 col-md-4">
    <div class="card contain-sm style-transparent">
    <div class="card-body">&nbsp;
    <div class="row">
    <div class="col-sm-12 user-login">
    <br>    
    
    <form action="http://dev-tshirtbomb.com/site/index" class="form floating-label">
        <div class="form-group">
        <input type="text" name="username" id="username" class="form-control">
        <label for="username">Username</label>
        </div>
        <div class="form-group">
        <input type="password" name="password" id="password" class="form-control">
        <label for="password">Password</label>

        </div>
        <div class="col-xs-12 text-right">
        <button type="button" id="login" class="btn btn-primary btn-raised">Login</button>
        </div><!--end .col -->
        <div class="row">

        <div class="col-xs-6 text-left">
        <div class="checkbox checkbox-inline checkbox-styled">
        <label>
        <input type="checkbox"> <span>Remember me</span>
        </label>
        </div>
        </div>
        <p class="help-block col-sm-6 col-md-6" id="forgot_pass"><a href="#">Forgot Password?</a></p>
        </div><!--end .row -->
        <p class="new_register">Didn't have account? <a class="new_user_login" href="#">Register here</a></p>
        <input type="hidden" value="login" name="page">
        <input type="hidden" value="test" name="abacies" data-myAttri="deep">
    </form>
    </div><!--end .col -->
    </div>
    </div>
    </div>
    <div style="display: none;" id="rec_password" class="bpopup details">
        <div class="col-md-12">
        <img alt="" src="<?php echo Yii::getAlias('@web').'/images/closebutton.png' ?>" class="pull-right" id="pop_img_close">
        </div>
        <div class="alert alert-warning" role="alert">
        <strong>Note!</strong> User details will be sent to your email id.
        </div>
        <div class="col-md-12">
            <form method="post" action="" class="form floating-label">
            <div class="form-group">
            <input type="text" name="email" id="email" class="form-control">
            <label for="email">Email</label>
            </div>
            <div class="col-sm-12 text-right">
            <button type="button" id="recovery" class="btn btn-primary btn-raised">Submit</button>
            </div>
            </form>
        </div>
    </div>	
</section>
</div>
