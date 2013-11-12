<?php
$this->breadcrumbs=array(
	'Employee Types',
);

$this->menu=array(
	array('label'=>'Create EmployeeType', 'url'=>array('create')),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1>Employee Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
