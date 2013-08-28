<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
);
?>

<h1>Manage Rooms</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'room-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'title',
        array( 
            'name'=>'roomTypeDescription',
            'value'=>'$data->roomType->description',
        ),
        'bed_num',
        array(
            'header'=>'Options',
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
