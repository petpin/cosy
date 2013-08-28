<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>Create Package</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>