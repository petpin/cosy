<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	'Create',
);
?>

<h1>Create Supplier</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>