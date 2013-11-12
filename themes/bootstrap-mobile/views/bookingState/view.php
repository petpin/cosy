<?php
$this->breadcrumbs=array(
	'Booking States'=>array('index'),
	$model->description,
);



$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'Update BookingState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookingState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1>View BookingState #<?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
