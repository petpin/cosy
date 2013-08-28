<?php
$this->breadcrumbs=array(
	'Booking States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1>Create BookingState</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>