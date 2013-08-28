<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/main.css" media="screen,projection">
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/print.css" media="print">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<header>                       
		<div class="wrap">

			<a id="logo" href="./" title="<?php echo Yii::app()->name ?>"><?php echo Yii::app()->name ?></a>
			
			<hr> 
			
			<nav>
				<div id="nav">
					<strong>Navigation</strong>
					<ul>
						<!--
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'User', 'url'=>array('/user/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Portal', 'url'=>array('/portal/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Package', 'url'=>array('/package/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Feature', 'url'=>array('/feature/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'State', 'url'=>array('/state/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						array('label'=>'Contact', 'url'=>array('/site/contact')),
						-->
						<li class="active">
							<?php echo CHtml::link('Home',array('site/index')); ?>
						</li>
						<!--<li>
							<?php echo CHtml::link('User',array('user/admin')); ?>
						</li>-->  
						<li class="parent">
							<?php //echo CHtml::link('About',array('site/page')); ?>
							<a>About</a>
							<ul>
								<li>
									<a href="">Company</a>
								</li>
								<li>
									<a href="">Persons</a>
								</li>
								<li>
									<a href="">Application</a>
								</li>
							</ul>
						</li>                        
						<!--<li>
							<a href="./" title="Blog">Blog</a>
						</li>-->  
						<li>
							<?php echo CHtml::link('Contact',array('site/contact')); ?>
						</li>
					</ul> 
				</div>         
			</nav>

		</div>
	</header>

	<hr>
	
	<?php echo $content; ?>
	
	<hr class="noPrint">

	<div id="twitter">
		<div class="wrap clearFix">
			<span class="icon"></span>
			<p>You can easly follow us on twitter and check <a href="./">CosyApp</a> updates temp. <small>2 days ago</small></p>
		</div>
	</div>

	<hr>
	
	<footer>
		<div class="wrap clearFix">
			
			<p class="floatLeft">
				Copyright &copy; 2013 <a href="./">CosyApp</a> &ndash; Hostels Management<br>
				Simple, easly and low-cost <a href="./">NM</a> software
			</p>        

			<p class="socialIcons floatRight">
				<a href="./" class="rss">RSS</a>
				<a href="./" class="facebook">Facebook</a>
				<a href="./" class="twitter">Twitter</a>
			</p>        
			
		</div>            
	</footer>

</body>
</html>