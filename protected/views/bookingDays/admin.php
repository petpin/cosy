<?php $this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_DAYS')=>array('admin'),
	Yii::t('contentForm','MANAGE'),
); ?>

<h1><?php echo Yii::t('contentForm','MANAGE_BOOKING_DAYS'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'booking-days-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id_booking',
        'day',
        'id_supplier',
        'price',
        'id_room',
        'bed_num',
        /* 'supplier_rate', */
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
