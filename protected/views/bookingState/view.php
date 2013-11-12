<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_STATES')=>array('index'),
	$model->description,
);



$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'Update BookingState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookingState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('contentForm','CONFIRM_DELETE_ITEM'))),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','VIEW_BOOKING_STATES'); ?> #<?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
