<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Supplier', 'url'=>array('index')),
	array('label'=>'Create Supplier', 'url'=>array('create')),
);
?>

<h1>Manage Suppliers</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'supplier-grid',
    'dataProvider'=>$model->search(),
	'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'filter'=>$model,
    'columns'=>array(
        //'id',
        'name',
        'url',
        'rate_value',
        array(
                'class'=>'CButtonColumn',
        ),
    ),
)); ?>
