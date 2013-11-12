<?php $this->breadcrumbs=array(
	'Booking Days'=>array('admin'),
	'View day ' . $model->day . ' of ' . $model->id_booking . ' booking',
); ?>

<h2>Day <?php echo $model->day; ?> of Booking <?php echo $model->id_booking; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
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
