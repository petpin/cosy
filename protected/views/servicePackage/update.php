<?php
$this->breadcrumbs=array(
	'Service Packages'=>array('admin'),
	$model->id_service=>array('view','id'=>$model->Array),
	'Update',
);

?>

<h2>Update ServicePackage <?php echo $model->Array; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>