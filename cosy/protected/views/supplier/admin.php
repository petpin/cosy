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
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
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
