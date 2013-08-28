<?php
$this->breadcrumbs=array(
	'Portals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Portal', 'url'=>array('index')),
	array('label'=>'Manage Portal', 'url'=>array('admin')),
);
?>

<h1>Create Portal</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>