<?php
$this->breadcrumbs=array(
	'Employee Types'=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List EmployeeType', 'url'=>array('index')),
	array('label'=>'Create EmployeeType', 'url'=>array('create')),
	array('label'=>'Update EmployeeType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmployeeType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1>View Employee Type <?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'description',
	),
)); ?>
