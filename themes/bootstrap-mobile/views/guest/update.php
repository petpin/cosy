<?php $this->breadcrumbs=array(
	'Guests'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
); ?>

<h1>Update Guest <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>