<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/html.css" media="screen, projection, tv " />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css"  media="screen, projection, tv"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="content">

	<div id="header">

		<div id="title">
			<h1>Cosy</h1>
			<h2>easy planning</h2>
		</div>

		<img src="themes/cool/images/bg/balloons.gif" alt="balloons" class="balloons" />
		<img src="themes/cool/images/bg/header_left.jpg" alt="left slice" class="left" />
		<img src="themes/cool/images/bg/header_right.jpg" alt="right slice" class="right" />

	</div>

	<!-- Falta perceber como mudar a class dos elementos do menu consuante se vai alterando -->
	<?php include 'menu.php'?>
	
	<div class="clear"></div>

    <?php echo $content; ?>

</div>



<div id="footer">

	<div id="width">
		<span class="floatLeft">
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
		</span>

		<?php 
		if(!Yii::app()->user->isGuest)
		{
		?>
		
		<span class="floatRight">
		<a href="index.php?r=site/index" title="Introduction">intro</a> <span class="grey">|</span>
		<a href="index.php?r=booking/index" title="Learn how to use the template">booking</a> <span class="grey">|</span>
		<a href="index.php?r=site/management" title="View the styled tags">management</a>
		</span>
		
		<?php
		}
		
			?>
	</div>

</div>
	
</body>
</html>
