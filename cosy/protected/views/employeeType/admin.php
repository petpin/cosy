<?php
$this->breadcrumbs=array(
    'Employee Types'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List EmployeeType', 'url'=>array('index')),
    array('label'=>'Create EmployeeType', 'url'=>array('create')),
);
?>

<h1>Manage Employee Types</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'employee-type-grid',
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
