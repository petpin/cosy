<?php
$this->breadcrumbs=array(
	'Packages'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

<h2>Update Package <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>