<?php
$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	'Create',
);

?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Manage',
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employee/admin", array('id'=>$model->id)),
)); ?>

<h1>Create Employee</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>