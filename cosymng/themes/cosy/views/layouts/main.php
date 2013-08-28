<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

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
	<div id="header">
		<div id="logo" style="font:50px 'Great Vibes', cursive white;"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
    <!--
<?php /*$this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
                array('label'=>'Dashboard', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'test')),
                array('label'=>'Theme Pages',
                  'items'=>array(
                    array('label'=>'Graphs & Charts', 'url'=>array('/site/page', 'view'=>'graphs'),'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Form Elements', 'url'=>array('/site/page', 'view'=>'forms')),
					array('label'=>'Interface Elements', 'url'=>array('/site/page', 'view'=>'interface')),
					array('label'=>'Error Pages', 'url'=>array('/site/page', 'view'=>'Demo 404 page')),
					array('label'=>'Calendar', 'url'=>array('/site/page', 'view'=>'calendar')),
					array('label'=>'Buttons & Icons', 'url'=>array('/site/page', 'view'=>'buttons_and_icons')),
                  ),
                ),
                array('label'=>'Gii Generated Module',
                  'items'=>array(
                    array('label'=>'Items', 'url'=>array('/theme/index')),
                    array('label'=>'Create Item', 'url'=>array('/theme/create')),
					array('label'=>'Manage Items', 'url'=>array('/theme/admin')),
                  ),
                ),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
    )); */?> --->
	<div id="mainmenu">
    
	<?php 
		if(!Yii::app()->user->isGuest)
		{
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('accesskey'=>'i')),
					array('label'=>'Report', 'url'=>array('/report/year'), 'itemOptions'=>array('accesskey'=>'')),
					array('label'=>'Booking', 'url'=>array('/booking/admin'), 'itemOptions'=>array('class'=>'icon_chart')),
					array('label'=>'Room', 'url'=>array('/room/admin'), 'itemOptions'=>array('accesskey'=>'r')),
					array('label'=>'Guest', 'url'=>array('/guest/admin'), 'itemOptions'=>array('accesskey'=>'g')),				
					array('label'=>'Employee', 'url'=>array('/employee/admin'), 'itemOptions'=>array('accesskey'=>'e')),
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
		Copyright &copy; <?php echo date('Y'); ?> by nelsonjvf.com<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>