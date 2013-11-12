<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="description" content="Cosy, hotel, hostel, residencial, surf house, surf camp management">
	<meta name="keywords" content="Cosy,CosyApp,hotel,hostel,residencial,surf,house,camp,management">
	<meta name="author" content="CosyApp - NM">
	<link rel="shortcut icon" href="images/cosy.ico" type="image/x-icon">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->bootstrap->register(); ?>
	<link rel="stylesheet" type="text/css" href="./css/cosy.css" />
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
				array('label'=>Yii::t('contentForm','BOOKINGS'), 'url'=>array('/booking/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('contentForm','GUESTS'), 'url'=>array('/guest/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('contentForm','REPORT'), 'url'=>'#', 'items'=>array(
					array('label'=>Yii::t('contentForm','YEARLY'), 'url'=>array('/report/year'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','MONTHLY'), 'url'=>array('/report/month'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
                    array('label'=>Yii::t('contentForm','GUESTS')),
                    array('label'=>Yii::t('contentForm','CHECK_IN/OUT'), 'url'=>array('/report/dailyReport'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','GUESTS_TODAY'), 'url'=>array('/report/guestReport'), 'visible'=>!Yii::app()->user->isGuest),
					'---',
                    array('label'=>Yii::t('contentForm','SUPPLIERS')),
                    array('label'=>Yii::t('contentForm','NUMBER_BOOKINGS'), 'url'=>array('/report/supplierBooking'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','NUMBER_CLIENTS'), 'url'=>array('/report/supplierClients'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','MONEY_RECEIVED'), 'url'=>array('/report/supplierMoney'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','PAID_RATES'), 'url'=>array('/report/supplierRate'), 'visible'=>!Yii::app()->user->isGuest),
                    
                ), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('contentForm','MANAGE'), 'url'=>'#', 'items'=>array(
					array('label'=>Yii::t('contentForm','ROOM'), 'url'=>array('/room/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','ROOM_TYPE'), 'url'=>array('/roomType/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
					array('label'=>Yii::t('contentForm','EMPLOYEE'), 'url'=>array('/employee/admin'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>Yii::t('contentForm','EMPLOYEE_TYPE'), 'url'=>array('/employeeType/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
                    //array('label'=>'Supplier'),
                    array('label'=>Yii::t('contentForm','SUPPLIER'), 'url'=>array('/supplier/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    '---',
                    array('label'=>Yii::t('contentForm','Packages'), 'url'=>array('/package/admin'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>Yii::t('contentForm','Services'), 'url'=>array('/service/admin'), 'visible'=>!Yii::app()->user->isGuest),
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
            	array('label'=>Yii::app()->language, 'url'=>'#', 'items'=>array(
	            	array('label'=>Yii::t('contentForm','en'), 'url'=>'index.php?' . $_SERVER['QUERY_STRING'] . '&lang=en'),
	            	array('label'=>Yii::t('contentForm','es'), 'url'=>'index.php?' . $_SERVER['QUERY_STRING'] . '&lang=es'),
	            	array('label'=>Yii::t('contentForm','pt'), 'url'=>'index.php?' . $_SERVER['QUERY_STRING'] . '&lang=pt'),
	            )),
	            array('label'=>Yii::t('contentForm','LOGIN'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    array('label'=>Yii::t('contentForm','PROFILE'), 'url'=>array('/employee/view', 'id'=>Yii::app()->user->id)),
                    '---',
                    array('label'=>Yii::t('contentForm','LOGOUT'), 'url'=>array('/site/logout')),
                ), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
));
?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div style="clear: both;"></div>

	<hr>

	<div id="footer" style="text-align: center; padding-top: 10px; padding-bottom: 20px;">
		<img src="images/cosyLogo.png" style="height: 30px;" /><br/>
		<small>Copyright &copy; <?php echo date('Y'); ?> by Cosy. <!--Welcome <?php echo CHttpRequest::getUserHostAddress(); ?>--></small><br/>
		<small>All Rights Reserved.</small><br/>
		<!--<small>Powered by <?php echo CHtml::link('Yii framework', 'http://www.yiiframework.com', array('target'=>'_blank')); ?></small>-->
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>