<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" media="screen,projection">
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<header>                       
		<div class="wrap">

			<a id="logo" href="./" title="Continents">Continents</a>
			
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
						<li>
							<?php echo CHtml::link('User',array('user/admin')); ?>
						</li>
						<li class="parent">
							<?php echo CHtml::link('About',array('site/page')); ?>
							<ul>
								<li>
									<a href="./">Lorem ipsum</a>
								</li>
								<li>
									<a href="./">Lorem ipsum</a>
								</li>
								<li>
									<a href="./">Lorem ipsum</a>
								</li>
							</ul>
						</li>                            
						<li>
							<a href="./" title="Blog">Blog</a>
						</li>
						<li>
							<a href="./" title="Contact">Contacts</a>
						</li>
					</ul> 
				</div>         
			</nav>

		</div>
	</header>

	<hr>

	<div id="intro">
		<div class="inner">
			<div class="wrap clearFix">
				
				<h1>Share something. <strong>Worldwide.</strong></h1>
				
				<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>                    
				
				<a href="./" class="button" title="SIGN UP">SIGN UP</a>                    

			</div>
		</div>
	</div> <!-- / #intro -->                        

	<hr>  
	
	<div id="content">                
		<div class="wrap clearFix">
				   
			<h2>SOME OF THE COOL FEATURES</h2>  
			
			<div class="clearFix">
				<div class="col floatLeft">

					<img src="img/icon-location.png" alt="" class="icon">

					<h3>Location Services</h3>

					<p>Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, austo odio, dapibus ac facilisis in.</p>

				</div>

				<div class="col floatRight">

					<img src="img/icon-backup.png" alt="" class="icon">
					
					<h3>24/7 Back Up</h3>

					<p>Maecenas faucibus mollis interdum. Donec ullamcorpe it libero, a pharetra r nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in.</p>

				</div>
			</div>

			<div class="clearFix">
				<div class="col floatLeft">

					<img src="img/icon-twitter.png" alt="" class="icon">

					<h3>Twitter Integration</h3>

					<p>Maecenas faucibus mollis interdum. Donec <a href="./">ullamcorper nulla</a> non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in.</p>

				</div>

				<div class="col floatRight">

					<img src="img/icon-stats.png" alt="" class="icon">
					
					<h3>Full Realtime Statistics</h3>

					<p>Maecenas faucibus mollis interdum. Donec ullamcorper nuletus auctor fringilla. Nulla vitae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in.</p>

				</div>
			</div>

			<div class="clearFix">
				<div class="col floatLeft">

					<img src="img/icon-tools.png" alt="" class="icon">

					<h3>Highly Customisable</h3>

					<p>Maecenas faucibus mollis interdum. Donec ullamcorper nulla non auctor fringilla. Nulla viit libero, a pharetra tae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in.</p>

				</div>

				<div class="col floatRight">

					<img src="img/icon-awards.png" alt="" class="icon">
					
					<h3>Award Winner Service</h3>

					<p>Maecenas follis interdum. Metus auctor it libero, a pharetra  fringilla. Nulla vitae elit libero, a pharetra augue. Cras justo odio, dapibus ac facilisis in.</p>

				</div>
			</div>

			<div class="buttonCentered">
				<a href="./" class="button iconRight">TAKE A FEATURE TOUR <i class="more"></i></a>
			</div>

			<h2>WHAT OUR CUSTOMERS ARE SAYING</h2>

			<ul class="cols clearFix">
				<li>
					<p>Nullam id dolor id nibh ultricies vehicula id elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui. Vivamus sagittis.</p>
					<p><strong>John Doe</strong>, Apple</p>
				</li>
				<li class="middle">
					<p>Nullam id dolor id nibh ultricies vehicula id elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui. Vivamus sagittis.</p>
					<p><strong>John Doe</strong>, Apple</p>
				</li>
				<li>
					<p>Nullam id dolor id nibh ultricies vehicula id elit. Donec id elit non mi porta gravida at eget metus. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui. Vivamus sagittis.</p>
					<p><strong>John Doe</strong>, Apple</p>
				</li>
			</ul>

			<form action="./" method="post">
				<fieldset>

					<label for="email">To stay in touch, simply subscribe to our newsletter.</label>
					<input type="text" class="text" id="email">
					<button type="submit" class="button iconLeft"><i class="email"></i> SUBSCRIBE</button> 

				</fieldset>
			</form>

		</div>
	</div> <!-- / #content -->      
	
	<hr class="noPrint">

	<div id="twitter">
		<div class="wrap clearFix">
			<span class="icon"></span>
			<p>Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis <a href="./">bit.ly/Pih1OA</a> <small>2 days ago</small></p>
		</div>
	</div>

	<hr>
	
	<footer>
		<div class="wrap clearFix">
			
			<p class="floatLeft">
				Copyright &copy; 2012 <a href="./">Your Name</a> &ndash; Lorem ipsum dolor sit amet consectetur adipisicing elit sed<br>
				Free website template by <a href="http://www.templatestar.net">Templatestar.net</a>
				thanks to <a href="http://www.grilykrby.cz/">Gril Weber</a>
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