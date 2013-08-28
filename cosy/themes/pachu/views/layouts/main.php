<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="icon" type="image/png" href="<?php echo Yii::app()->baseUrl?>/images/cosy.ico" /> 

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/cosy.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/menu.css" />

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		 <?php echo CHtml::encode(Yii::app()->name); ?> 
		
	</div><!-- header -->
	
	<?php 
		//echo Yii::app()->user->role;
	?>
	
	<!-- 
	<div id="mainmenu">
		<?php
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Insert Booking', 'url'=>array('/site/booking'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Room', 'url'=>array('/room/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Guest', 'url'=>array('/guest/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Booking', 'url'=>array('/booking/index'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'BookingState', 'url'=>array('/bookingState/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Employee', 'url'=>array('/employee/index'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Employee Type', 'url'=>array('/employeeType/index'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Room Type', 'url'=>array('/roomType/index'), 'visible'=>!Yii::app()->user->isGuest),
				//array('label'=>'Language', 'url'=>array('/language/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			)
		)); ?>
	</div>
	 -->
	 
	<ul class="menu">
		
		<?php 
		if(!Yii::app()->user->isGuest)
		{
		?>
		<li class="top"><a href="index.php?r=site/index" class="top_link"><span>Home</span></a></li>
		
		
		<li class="top"><a href="#" class="top_link"><span>Reports</span></a>
			<ul class="sub">				
				<li><a href="index.php?r=report/dailyReport">Guest</a>
						<ul class="sub2">			
							<li><a href="index.php?r=report/dailyReport"><?php echo utf8_encode('Check In & Out'); ?></a></li>
							<li><a href="index.php?r=report/guestReport"><?php echo utf8_encode('Guests Today'); ?></a></li>
						</ul>
				</li>
				<li><a href="index.php?r=report/month">General</a>			
					<ul class="sub2">			
						<li><a href="index.php?r=report/year">Year</a></li>
						<li><a href="index.php?r=report/month">Month</a></li>
					</ul>
				</li>				
				<li><a href="index.php?r=report/supplierBooking">Supplier</a>
						<ul class="sub2">			
							<li><a href="index.php?r=report/supplierBooking">Number Bookings</a></li>
							<li><a href="index.php?r=report/supplierClients">Number Clients</a></li>
							<li><a href="index.php?r=report/supplierMoney">Money Received</a></li>
							<li><a href="index.php?r=report/supplierRate">Paid Rates</a></li>
						</ul>
				</li>
			</ul>
		</li>
		<li class="top"><a href="#" class="top_link"><span>Booking</span></a>
			<ul class="sub">			
				<!--li><a href="index.php?r=booking/index">List</a></li-->
				<li><a href="index.php?r=booking/admin"><?php echo utf8_encode('Manage'); ?></a></li>
			</ul>
		</li>
		<li class="top"><a href="#" class="top_link"><span>Management</span></a>
			<ul class="sub">
				<li><a href="index.php?r=room/admin">Room</a>
						<ul class="sub2">
								<li><a href="index.php?r=room/create">Create</a></li>			
								<li><a href="index.php?r=room/index">List</a></li>
								<li><a href="index.php?r=room/admin">Manage</a></li>
						</ul>
				</li>			
				<li><a href="index.php?r=guest/admin">Guest</a>
						<ul class="sub2">
								<li><a href="index.php?r=guest/create">Create</a></li>			
								<li><a href="index.php?r=guest/index">List</a></li>
								<li><a href="index.php?r=guest/admin">Manage</a></li>
						</ul>
				</li>
			<?php	if(Yii::app()->user->isAdmin())
		{ ?>	
	            <li><a href="index.php?r=employee/admin">Employee</a>
						<ul class="sub2">
								<li><a href="index.php?r=employee/create">Create</a></li>			
								<li><a href="index.php?r=employee/index">List</a></li>
								<li><a href="index.php?r=employee/admin">Manage</a></li>
						</ul>
				</li>
			<?php } ?>	
				<li><a href="index.php?r=supplier/admin">Supplier</a>
						<ul class="sub2">
								<li><a href="index.php?r=supplier/create">Create</a></li>			
								<li><a href="index.php?r=supplier/index">List</a></li>
								<li><a href="index.php?r=supplier/admin">Manage</a></li>
						</ul>
				</li>
				<li><a href="index.php?r=roomType/admin">Room Type</a>
						<ul class="sub2">
								<li><a href="index.php?r=roomType/create">Create</a></li>			
								<li><a href="index.php?r=roomType/index">List</a></li>
								<li><a href="index.php?r=roomType/admin">Manage</a></li>
						</ul>
				</li>
			</ul>
		</li>
		<li class="toplog"><a href="index.php?r=site/logout" class="top_link"><span>Logout <?php echo '('.Yii::app()->user->name.')'; ?></span></a></li>
		<?php 
		}
		else
		{
		?>
		<li class="top"><a href="index.php?r=site/login" class="top_link"><span>Login</span></a></li>
		<?php 
		}
		?>
	</ul>
	
	 
	<!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by NM.<br/>
		All Rights Reserved.<br/>
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
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
