<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	$model->name=>array('view','id'=>$model->Array),
	'Update',
);

$this->menu=array(
	array('label'=>'List Package', 'url'=>array('index')),
	array('label'=>'Create Package', 'url'=>array('create')),
	array('label'=>'View Package', 'url'=>array('view', 'id'=>$model->Array)),
	array('label'=>'Manage Package', 'url'=>array('admin')),
);
?>

<h1>Update Package <?php echo $model->Array; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>