<?php
$this->breadcrumbs=array(
	'Features'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Features', 'url'=>array('index')),
	array('label'=>'Manage Features', 'url'=>array('admin')),
);
?>

<h1>Create Features</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>