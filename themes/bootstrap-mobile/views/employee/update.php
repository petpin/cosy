<?php
$this->breadcrumbs=array(
	'Employees'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Employee <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>