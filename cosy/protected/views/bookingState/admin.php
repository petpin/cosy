<?php
$this->breadcrumbs=array(
	'Booking States'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
);
?>

<h1>Manage Booking States</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'booking-state-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(	
        'description',
        array(
                'class'=>'CButtonColumn',
        ),
    ),
)); ?>
