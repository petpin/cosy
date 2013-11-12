<?php
$this->breadcrumbs=array(
	'Employee Types'=>array('admin'),
	'View',
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>
