<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->baseUrl?>/images/cosy.ico" /> 

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/cosy.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />
    
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Italiana' />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Great+Vibes' />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Junge' />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Philosopher' />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<!--
	<div id="topnav">
		<div class="topnav_text">
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
		</form> | 
		<a href='#'><?php echo Yii::app()->user->name; ?></a> | 
		<a href='#'>My Account</a> | 
		<a href='#'>Settings</a> | 
		<a href='#'>Logout</a> </div>
	</div>
	-->
	<div id="header">
		<div id="logo" style="font:50px 'Great Vibes', cursive white; color:white;"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
    
	<?php 
		if(!Yii::app()->user->isGuest)
		{
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('accesskey'=>'i')),
					array('label'=>'Report', 'url'=>array('/report/dailyReport'), 'itemOptions'=>array('accesskey'=>'d')),
					array('label'=>'Booking', 'url'=>array('/booking/admin'), 'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Room', 'url'=>array('/room/admin'), 'itemOptions'=>array('accesskey'=>'r')),
					array('label'=>'RoomType', 'url'=>array('/roomType/admin'), 'itemOptions'=>array('accesskey'=>'t')),
					array('label'=>'Guest', 'url'=>array('/guest/admin'), 'itemOptions'=>array('accesskey'=>'g')),				
					array('label'=>'Employee', 'url'=>array('/employee/admin'), 'itemOptions'=>array('accesskey'=>'e')),
					array('label'=>Yii::app()->user->name, 'url'=>array('/employee/view&id=' . Yii::app()->user->id), 'itemOptions'=>array('accesskey'=>'u')),
					//array('label'=>'Error Pages', 'url'=>array('/site/page')),
				),
			));
		}
		else
		{
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Login', 'url'=>array('/site/login'), 'itemOptions'=>array('accesskey'=>'l')),
				),
			));
		}	
	?>
	</div> <!--mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by cosyapp.com<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
	
	<?php
	if(!Yii::app()->user->isGuest)
	{
	?>
	<p/><p/>
	<div style="clear:both; text-align:center;">
		<div>
			Theme: <form name='form1' id='form1' method='post' action='<?php echo CHtml::normalizeUrl(array('index')); ?>' style='margin:0;padding:0;'><SELECT name='mytheme' onchange='Javascript:document.form1.submit()'>
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

</div><!-- page -->

</body>
</html>