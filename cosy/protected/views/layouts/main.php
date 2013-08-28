<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="Cosy, hotel, hostel, residencial management">
	<meta name="author" content="Cosy @ NM">

	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="../js/jquery-1.4.2.min.js"><\/script>')</script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<script src="www.energycell.co.uk/js/jquery.validationEngine-en.js"></script>
	<script src="www.energycell.co.uk/js/jquery.validationEngine.js"></script>
	
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
				<a class="brand" href="<?php echo Yii::app()->createUrl('site/index'); ?>"><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'Booking', 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Report', 'url'=>array('/report/year'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Guest', 'url'=>array('/guest/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Room', 'url'=>array('/room/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Room Type', 'url'=>array('/roomType/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Employee', 'url'=>array('/employee/admin'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Employee Type', 'url'=>array('/employeeType/admin'), 'visible'=>!Yii::app()->user->isGuest),
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
	
	<?php
	if(!Yii::app()->user->isGuest)
	{
	?>
	<p/><p/>
	<div style="clear:both; text-align:center;">
		<div>
			Theme: <form name='form1' id='form1' method='post' action='<?php echo CHtml::normalizeUrl(array('site/index')); ?>' style='margin:0;padding:0;'><SELECT name='mytheme' onchange='Javascript:document.form1.submit()'>
				<?php
					$arrTheme = Yii::app()->params['arrTheme'];

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
	<?php   
	}
	?>

</body>
</html>
