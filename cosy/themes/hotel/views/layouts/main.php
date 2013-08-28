<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cosy.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" />

	<!-- JQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="../js/jquery-1.4.2.min.js"><\/script>')</script>

	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<script src="www.energycell.co.uk/js/jquery.validationEngine-en.js"></script>
	<script src="www.energycell.co.uk/js/jquery.validationEngine.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="topstrip"></div>

<nav id="mainnav">
	<!--<span class="logo">
		<?php echo CHtml::link('Cosy', array('site/index'), array('id'=>'nav_home', 'accesskey'=>'h')); ?>
	</span>
	<ul>
	    <?php 
		if(!Yii::app()->user->isGuest)
		{
		?>
		<li><?php echo CHtml::link('Home', array('site/index'), array('id'=>'nav_home', 'accesskey'=>'h')); ?></li>
	    <li><?php echo CHtml::link('Booking', array('booking/admin'), array('id'=>'nav_booking', 'accesskey'=>'b')); ?></li>
	    <li><?php echo CHtml::link('Room', array('room/admin'), array('id'=>'nav_about', 'accesskey'=>'r')); ?></li>
	    <li><?php echo CHtml::link('Guest', array('guest/admin'), array('id'=>'nav_about', 'accesskey'=>'g')); ?></li>
	    <li><?php echo CHtml::link('Employee', array('employee/admin'), array('id'=>'nav_about', 'accesskey'=>'e')); ?></li>
	    <li><?php echo CHtml::link('Logout (' . Yii::app()->user->name . ')', array('site/logout'), array('id'=>'nav_login', 'accesskey'=>'l')); ?></li>
	    <?php 
		}
		else
		{
		?>
		<li><?php echo CHtml::link('Login', array('site/login'), array('id'=>'nav_login', 'accesskey'=>'l')); ?></li>
		<?php 
		}
		?>
	</ul>
	-->
</nav>

<?php //require(dirname(__FILE__).'/menu.php'); ?>

<div id="contentwrapper">
	<div id="skip"></div>
	<section>
	 
	<?php if(isset($this->breadcrumbs)): ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif ?>

	<body style="font: normal 13px arial,sans-serif; background-color: #F1F1F1; 
min-height: 100%; min-width: 960px;border-top: 0; clear: both; 
margin: 20px 0; position: relative; width: 100%;">

<div></div>

<div style="float:left;
width:70px;
height: 100%;
margin: 20px 20px;
background-clip: padding-box;
/*border: 1px solid #D7D7D7;*/">

	<div style="height:70px; text-align:center;"><img style="height:40px;" src="http://nelsonjvf.com/yii/hotel/images/blend_042.png" /></div>
	<div style="height:70px; text-align:center;"><img style="height:40px;" src="http://nelsonjvf.com/yii/hotel/images/blend_051.png" /></div>
	<div style="height:70px; text-align:center;"><img style="height:40px;" src="http://nelsonjvf.com/yii/hotel/images/blend_047.png" /></div>
	<div style="height:70px; text-align:center;"><img style="height:40px;" src="http://nelsonjvf.com/yii/hotel/images/blend_028.png" /></div>

</div>

<div style="
white-space: nowrap;
height: 90%;
vertical-align: top;
margin: 0 252px 0 100px;
-webkit-border-radius: 4px 4px 4px 4px;
-moz-border-radius: 4px 4px 4px 4px;
border-radius: 4px 4px 4px 4px;
background-color: white;
border: 1px solid #D7D7D7;
position: relative;
width: auto;">

<div style="height:250px; margin: 10px 0px; border: 1px solid #D7D7D7;
-webkit-border-radius: 4px 0px 0px 4px;
-moz-border-radius: 4px 0px 0px 4px;
border-radius: 4px 0px 0px 4px;
width:65%; float:left">
  <div style="margin:10px;">CONTENTs</div>
</div>

<div style="margin: 10px 0px; border-bottom:1px solid #D7D7D7; border-top:1px solid #D7D7D7; border-right:1px solid #D7D7D7; -webkit-border-radius: 0px 4px 4px 0px;
-moz-border-radius: 0px 4px 4px 0px; border-radius: 0px 4px 4px 0px; width:30%; float:left">
	<div style="margin:10px;">
		<img style="height:20px;" src="http://nelsonjvf.com/yii/hotel/images/blend_060.png" /> TIMEs <br/><br/>
		<img style="height:20px;" src="http://nelsonjvf.com/yii/hotel/images/blend_035.png" /> CLIENTs <br/><br/>
		<img style="height:20px;" src="http://nelsonjvf.com/yii/hotel/images/blend_043.png" /> MOREs
	</div>
</div>

</div>
	
	<?php echo $content; ?>
	
	<div class="clear"></div>

	</section>

	<footer id="calltoactions">
	<div id="calltoactions_wrapper">
	           <dl>
	                <dt>Try it free</dt>
	                <dd><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/blog_icon.jpg" width="90" height="90" alt="Our Blog" /></dd>
	                <dd>You can try it free</dd>
	                <dd><a href="wordpress">I want to see more...</a></dd>
	           </dl>
	           <dl>
	                <dt>With Support</dt>
	                <dd><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/quote_icon.jpg" width="68" height="90" alt="Our Blog" /></dd>
	                <dd>We will give you all the support that you need.</dd>
	                <dd><a href="contact.html">I would like...</a></dd>
	           </dl>
	          <dl id="phone">
	                <dt>Demonstration</dt>
	                <dd>Take a look</dd>
	           </dl>
	    </div>
	</footer><!--Call to Action Ends-->

	<footer id="pagefooter">
		<div id="foot_wrapper">
	        <div id="foot_address">
	          <h3> </h3>
	            <p>Hotel, Hostel, Motel</p>
	            <p>this is a solutions for you,</p>	
	            <p>for your business,</p>
	            <p>FOR YOUR IMPROVEMENT</p>
	            <p class="contacthighlight">Let Us Explain</p>
	        </div>
	        <div id="foot_nav">
	            <h3> </h3>
	            <ul>
	              <li><a href="about.html">What we're all <span class="orangehighlight">About</span></a></li>
	              <li><a href="services.html">The <span class="orangehighlight">Services</span> we offer</a></li>
	              <li><a href="work.html">Some of our best <span class="orangehighlight">Work</span></a></li>
	              <li><a href="clients.html"><span class="orangehighlight">Clients</span> we work with</a></li>
	              <li><a href="wordpress">Read our <span class="orangehighlight">Blog</span></a></li>
	              <li><a href="contact.html">How to <span class="orangehighlight">Contact</span> us</a></li>
	          </ul>   
	        </div>
	        <div id="foot_test"> 
		        <h3> </h3>
		        <div id="tweet">
					<form name='form1' id='form1' method='post' action='<?php echo CHtml::normalizeUrl(array('index')); ?>' style='margin:0;padding:0;'>Theme: <SELECT name='mytheme' onchange='Javascript:document.form1.submit()'>
					<?php
						$arrTheme = Yii::app()->params['arrTheme'];
						
						CVarDumper::dump($arrTheme);
						
						foreach($arrTheme as $value=>$display)
						{
							$dynamicTheme = (isset(Yii::app()->request->cookies['dynamicTheme']->value)) ? Yii::app()->request->cookies['dynamicTheme']->value : '';
							$s = '';
							if($value == $dynamicTheme) $s = 'selected';
							echo "<option value='$value' $s>$display</option>";
						}
					?></SELECT>
					</form>
		        </div>
	      	</div>
	  </div><!-- Footer Wrapper Ends-->
	</footer>

</body>
</html>
