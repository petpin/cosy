<?php
	Yii::app()->clientscript
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
		// use it when you need it!
		/*
		->registerCoreScript( 'jquery' )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="Cosy, hotel, hostel, residencial management">
	<meta name="author" content="Cosy @ NM">

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le styles -->
	<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}

		@media (max-width: 980px) {
			body{
				padding-top: 0px;
			}
		}
	</style>

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'User', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Portal', 'url'=>array('/portal/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Package', 'url'=>array('/package/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Feature', 'url'=>array('/feature/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'State', 'url'=>array('/state/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
						),
					));
					
					if(!Yii::app()->user->isGuest)
					{ 
					?>
					<p class="navbar-text pull-right">Logged in as <a href="<?php echo Yii::app()->createUrl('user/view', array('id'=>Yii::app()->user->id, 'name'=>Yii::app()->user->name)); ?>"><?php echo Yii::app()->user->name; ?></a> - <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Sign Out</a></p>
					<?php 
					}
					else
					{
					?>
					<p class="navbar-text pull-right"><a href="<?php echo Yii::app()->createUrl('site/login'); ?>">Login</a></p>
					<?php
					}
					?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div class="container">
		<?php echo $content ?>
	</div> <!-- /container -->
</body>
</html>
