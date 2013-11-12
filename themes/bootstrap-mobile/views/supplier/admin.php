<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	'Manage',
);
?>

<h1>Manage Suppliers</h1>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("supplier/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
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
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
