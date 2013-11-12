<?php
$this->breadcrumbs=array(
    'Employee Types'=>array('index'),
    'Manage',
);
?>

<h1>Manage Employee Types</h1>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employeeType/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'employee-type-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'description',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
