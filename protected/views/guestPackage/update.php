<?php
$this->breadcrumbs=array(
	'Guest Packages'=>array('admin'),
	$model->id_booking=>array('view','id'=>$model->Array),
	'Update',
);

?>

<h2>Update GuestPackage <?php echo $model->Array; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>