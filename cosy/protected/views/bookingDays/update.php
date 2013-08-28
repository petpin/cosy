<?php
$this->breadcrumbs=array(
	'Booking Days'=>array('admin'),
	$model->id_booking=>array('view', 'id'=>$model->id_booking, 'day'=>$model->day),
	'Update',
);
?>

<h1>Update Day <?php echo $model->day; ?> of Booking <?php echo $model->id_booking; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>