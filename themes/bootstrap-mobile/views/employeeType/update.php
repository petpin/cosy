<?php
$this->breadcrumbs=array(
	'Employee Types'=>array('index'),
	$model->description=>array('view','description'=>$model->description),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmployeeType', 'url'=>array('index')),
	array('label'=>'Create EmployeeType', 'url'=>array('create')),
	array('label'=>'View EmployeeType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1>Update Employee Type <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>