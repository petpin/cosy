<?php
$this->breadcrumbs=array(
	'Service Packages'=>array('admin'),
	'Create',
);

?>

<h2>Create ServicePackage</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>