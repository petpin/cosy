<?php
$this->breadcrumbs=array(
	'Bookings',
);

$this->menu=array(
array('label'=>'Manage Booking', 'url'=>array('admin')),
);
?>

<h1>Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
