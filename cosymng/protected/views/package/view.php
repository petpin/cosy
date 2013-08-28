<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Create Package', 'url'=>array('create')),
	array('label'=>'Update Package', 'url'=>array('update', 'id'=>$model->Array)),
	array('label'=>'Delete Package', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Array),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>View Package #<?php echo $model->Array; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'price_per_month',
		'discount',
	),
)); ?>
