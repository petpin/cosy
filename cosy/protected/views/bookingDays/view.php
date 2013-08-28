<?php
$this->breadcrumbs=array(
	'Booking Days'=>array('admin'),
	$model->id_booking,
);
?>

<h1>View Day <?php echo $model->day; ?> of Booking <?php echo $model->id_booking; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id_booking',
        'day',
        'price',
        'Room.title',
        'bed_num',
        'Supplier.name',
        'supplier_rate',
    ),
)); ?>
