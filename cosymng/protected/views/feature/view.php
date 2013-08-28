<?php
$this->breadcrumbs=array(
	'Features'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Features', 'url'=>array('index')),
	array('label'=>'Create Features', 'url'=>array('create')),
	array('label'=>'Update Features', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Features', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Features', 'url'=>array('admin')),
);
?>

<h1>View Features <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
