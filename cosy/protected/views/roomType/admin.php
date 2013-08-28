<?php
$this->breadcrumbs=array(
	'Room Types'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RoomType', 'url'=>array('index')),
	array('label'=>'Create RoomType', 'url'=>array('create')),
);
?>

<h1>Manage Room Types</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'room-type-grid',
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
