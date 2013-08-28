<?php
$this->breadcrumbs=array(
	'Portals'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Portal', 'url'=>array('index')),
	array('label'=>'Create Portal', 'url'=>array('create')),
	array('label'=>'View Portal', 'url'=>array('view', 'id'=>$model->id, 'name'=>$model->name)),
	array('label'=>'Manage Portal', 'url'=>array('admin')),
);
?>

<h1>Update Portal <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>