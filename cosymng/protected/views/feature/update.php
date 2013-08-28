<?php
$this->breadcrumbs=array(
	'Features'=>array('index'),
	$model->name=>array('view','id'=>$model->Array),
	'Update',
);

$this->menu=array(
	array('label'=>'List Features', 'url'=>array('index')),
	array('label'=>'Create Features', 'url'=>array('create')),
	array('label'=>'View Features', 'url'=>array('view', 'id'=>$model->Array)),
	array('label'=>'Manage Features', 'url'=>array('admin')),
);
?>

<h1>Update Features <?php echo $model->Array; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>