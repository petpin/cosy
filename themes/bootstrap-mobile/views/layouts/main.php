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
    'brandUrl'=>array('/site/index'),
    'collapse'=>false, // requires bootstrap-responsive.css - Mobile FUCKING MENU !
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('icon'=>'home', 'url'=>array('/site/index'), 'visible'=>!Yii::app()->user->isGuest),
				array('icon'=>'signal', 'url'=>'#', 'items'=>array(
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
            ),
            'htmlOptions' => array('class'=>'nav'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
            	array('label'=>Yii::app()->language, 'url'=>'#', 'items'=>array(
	            	array('label'=>Yii::t('contentForm','en'), 'url'=>array('', 'lang'=>'en')),
	            	array('label'=>Yii::t('contentForm','es'), 'url'=>array('', 'lang'=>'es')),
	            	array('label'=>Yii::t('contentForm','pt'), 'url'=>array('', 'lang'=>'pt')),
	            )),
	            array('label'=>Yii::t('contentForm','LOGIN'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('icon'=>'user', 'url'=>'#', 'items'=>array(
                    array('label'=>Yii::t('contentForm','PROFILE'), 'url'=>array('/employee/view', 'id'=>Yii::app()->user->id)),
                    ' --- ',
                    array('label'=>Yii::t('contentForm','LOGOUT'), 'url'=>array('/site/logout')),
                ), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>

<div class="container" id="page" style="padding: 0px;">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div style="clear: both;"></div>

	<hr>

	<div class="clear"></div>

	<div id="footer" style="text-align: center; padding-top: 10px;">
		Copyright &copy; <?php echo date('Y'); ?> by CosyApp.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
