<?php
$this->breadcrumbs=array(
	'Booking States',
);

$this->menu=array(
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1>Booking States</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
