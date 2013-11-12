<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_STATES'),
);

$this->menu=array(
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','BOOKING_STATES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
