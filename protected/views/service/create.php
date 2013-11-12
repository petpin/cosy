<?php
$this->breadcrumbs=array(
	'Services'=>array('admin'),
	'Create',
);

?>

<h2>Create Service</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>