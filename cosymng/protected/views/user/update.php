<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view', array('id'=>$model->id, 'name'=>$model->name)),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', array('id'=>$model->id, 'name'=>$model->name))),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>