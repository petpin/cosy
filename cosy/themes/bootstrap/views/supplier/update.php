<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Supplier <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>