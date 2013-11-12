<?php
$this->breadcrumbs=array(
	'Booking States'=>array('index'),
	$model->description=>array('view','description'=>$model->description),
	'Update',
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'View BookingState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1>Update Booking State <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>