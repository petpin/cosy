<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_STATES')=>array('index'),
	Yii::t('contentForm','MANGE'),
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('contentForm','MANAGE_BOOKING_STATES'); ?></h1>

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
