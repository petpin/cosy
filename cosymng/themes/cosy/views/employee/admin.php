<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);
?>

<h1>Manage Employees</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name', 'surname', 'phone', 'email', 'employeeType.description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
