<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	$model->name,
);
?>

<h1>View Supplier <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'url',
		'rate_value',
	),
)); ?>
