<?php
$this->breadcrumbs=array(
	'Employee'=>array('admin'),
	'View',
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Update',
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employee/update", array('id'=>$model->id)),
)); ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
		'surname',
		'phone',
		'email',
    ),
)); ?>
