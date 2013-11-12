<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	$model->description=>array('view','description'=>$model->description),
	'Update',
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index')),
	array('label'=>'Create Language', 'url'=>array('create')),
	array('label'=>'View Language', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Language', 'url'=>array('admin')),
);
?>

<h1>Update Language <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>