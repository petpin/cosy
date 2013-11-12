<?php $this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_DAYS')=>array('admin'),
	Yii::t('contentForm','VIEW_DAY{day}OF{booking}BOOKING',array('{day}' => $model->day, '{booking}' => $model->Booking->client_name)),
); ?>

<h2><?php echo Yii::t('contentForm','DAY'); ?> <?php echo $model->day; ?> <?php echo Yii::t('contentForm','OF_BOOKING'); ?> <?php echo $model->id_booking; ?></h2>

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
