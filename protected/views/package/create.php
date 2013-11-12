<?php
$this->breadcrumbs=array(
	'Packages'=>array('admin'),
	'Create',
);

?>

<h2>Create Package</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>