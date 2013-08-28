<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="Cosy, hotel, hostel, residencial management">
	<meta name="author" content="Cosy @ NM">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/cosy.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    //'type'=>'inverse', // null or 'inverse'
    //'brand'=>'Project name',
    'brandUrl'=>array('/site/index'),
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                //array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Booking', 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Guest', 'url'=>array('/guest/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Report', 'url'=>'#', 'items'=>array(
					array('label'=>'Year', 'url'=>array('/report/year'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Month', 'url'=>array('/report/month'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
                    array('label'=>'Clients'),
                    array('label'=>'Check In/Out', 'url'=>array('/report/dailyReport'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Guests Today', 'url'=>array('/report/guestReport'), 'visible'=>!Yii::app()->user->isGuest),
					'---',
                    array('label'=>'Suppliers'),
                    array('label'=>'Number Bookings', 'url'=>array('/report/supplierBooking'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Number Clients', 'url'=>array('/report/supplierClients'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Money Received', 'url'=>array('/report/supplierMoney'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Paid Rates', 'url'=>array('/report/supplierRate'), 'visible'=>!Yii::app()->user->isGuest),
                    
                ), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Manage', 'url'=>'#', 'items'=>array(
					array('label'=>'Room', 'url'=>array('/room/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Room Type', 'url'=>array('/roomType/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
					array('label'=>'Employee', 'url'=>array('/employee/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Employee Type', 'url'=>array('/employeeType/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
                    //array('label'=>'Supplier'),
                    array('label'=>'Supplier', 'url'=>array('/supplier/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    //'---',
                    //array('label'=>'Separated link', 'url'=>'#'),
                    //array('label'=>'One more separated link', 'url'=>'#'),
                ), 'visible'=>!Yii::app()->user->isGuest),	
            ),
        ),
        //'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
	            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>'Perfil', 'url'=>array('/employee/view', 'id'=>Yii::app()->user->id)),
                    '---',
                    array('label'=>'Logout', 'url'=>array('/site/logout')),
                ), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div style="clear: both;"></div>

	<hr>

	<div class="clear"></div>

	<div id="footer" style="text-align: center; padding-top: 20px;">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		Powered by <?php echo CHtml::link('Yii framework', 'http://www.yiiframework.com', array('target'=>'_blank')); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
