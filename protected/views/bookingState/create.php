<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_STATES')=>array('index'),
	Yii::t('contentForm','CREATE'),
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','CREATE_BOOKING_STATE'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>