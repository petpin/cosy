<?php
$this->breadcrumbs=array(
	'Employee Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmployeeType', 'url'=>array('index')),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1>Create EmployeeType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>