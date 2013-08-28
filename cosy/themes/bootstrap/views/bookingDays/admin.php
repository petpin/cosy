<?php $this->breadcrumbs=array(
	'Booking Days'=>array('admin'),
	'Manage',
); ?>

<h1>Manage Booking Days</h1>

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
