<?php
$this->breadcrumbs=array(
	'Guest Packages'=>array('admin'),
	'Create',
);

?>

<h2>Create GuestPackage</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>