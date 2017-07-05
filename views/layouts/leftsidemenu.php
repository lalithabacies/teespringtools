<?php 

use yii\helpers\Url;
$session = Yii::$app->session;

?>

		<div id="menubar" class="menubar-inverse ">
			<div class="menubar-scroll-panel">
				<ul id="main-menu" class="gui-controls">
					<li>
						<a href="<?= Url::to(["site/home"]); ?>" class="active">
							<div class="gui-icon"><i class="md md-home"></i></div>
							<span class="title">Dashboard</span>
						</a>
					</li>
				<?php if(!empty($session['isAdmin'])){ ?>	
					<li class="gui-folder">
						<a>
							<div class="gui-icon"><i class="md md-person"></i></div>
							<span class="title">User Management</span>
						</a>
						<ul>
						<li><a href="<?= Url::to(["user/index"]); ?>" ><span class="title">All Users</span></a></li>
							<li><a href="<?= Url::to(["user/create"]); ?>" ><span class="title">Add User</span></a></li>							
						</ul>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?= Url::to(["user/user-log"]); ?>" >
							<div class="gui-icon"><i class="md md-person"></i></div>
							<span class="title">User Mangement</span>
						</a>
					</li>
				<?php } ?>	
					<li>
						<a href="<?= Url::to(["domain/index"]); ?>" >
							<div class="gui-icon"><i class="md md-laptop"></i></div>
							<span class="title">Domain Mangement</span>
						</a>
					</li>
					
					<li>
						<a href="<?= Url::to(["ticket/index"]); ?>" >
							<div class="gui-icon"><i class="fa fa-tag"></i></div>
							<span class="title">Ticket System</span>
						</a>
					</li>
					
					<li>
						<a href="<?= Url::to(["blog/index-blog"]); ?>" >
							<div class="gui-icon"><i class="fa fa-rss"></i></div>
							<span class="title">Blogs</span>
						</a>
					</li>
					<?php if(!empty($session['isAdmin'])){ ?>
					<li>
						<a href="<?= Url::to(["site/home"]); ?>" >
							<div class="gui-icon"><i class="fa md-apps fa-fw"></i></div>
							<span class="title">Access Apps</span>
						</a>
					</li>
					<li class="gui-folder">
						<a>
							<div class="gui-icon"><i class="glyphicon glyphicon-wrench"></i></div>
							<span class="title">Application Settings</span>
						</a>
						<ul>
						<li><a href="<?= Url::to(["applist/index"]); ?>" ><span class="title">Application Display</span></a></li>
					
						</ul>
					</li>
					
					<li class="gui-folder">
						<a>
							<div class="gui-icon"><i class="md md-accessibility"></i></div>
							<span class="title">User Roles Management</span>
						</a>
						<ul>
						<li><a href="<?= Url::to(["roles/settings"]); ?>" ><span class="title">Role Setting</span></a></li>
						<li><a href="<?= Url::to(["roles/details"]); ?>" ><span class="title">Role Details</span></a></li>
						<li><a href="<?= Url::to(["roles/index"]); ?>" ><span class="title">Default Role Settings</span></a></li>
						<li><a href="<?= Url::to(["roles/user-roles"]); ?>" ><span class="title">User Role</span></a></li>
					
						</ul>
					</li>
					
					<li>
						<a href="<?= Url::to(["site/access"]); ?>" >
							<div class="gui-icon"><i class="fa fa-puzzle-piece fa-fw"></i></div>
							<span class="title">Access Settings</span>
						</a>
					</li>	

					<li>
						<a href="<?= Url::to(["managekey/index"]); ?>" >
							<div class="gui-icon"><i class="fa fa-key"></i></div>
							<span class="title">Manage Key</span>
						</a>
					</li>
					
					<li>
						<a href="<?= Url::to(["blog/index"]); ?>" >
							<div class="gui-icon"><i class="fa fa-rss-square"></i></div>
							<span class="title">Manage Blogs</span>
						</a>
					</li>
					
					<li>
						<a href="<?= Url::to(["user/user-log"]); ?>" >
							<div class="gui-icon"><i class="fa fa-cogs"></i></div>
							<span class="title">User log</span>
						</a>
					</li>
					
					<?php } ?>
					
					<li>
						<a href="<?= Url::to(["site/logout"]); ?>">
							<div class="gui-icon"><i class="fa fa-fw fa-power-off"></i></div>
							<span class="title">Logout</span>
						</a>
					</li>
					
				</ul>
			</div>
		</div><!--end #menubar-->

	