<?php
$this->breadcrumbs=array(
	'States'=>array('index'),
	'Manage',
);
?>

<h1>Manage States</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'state-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
