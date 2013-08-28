<?php
$this->breadcrumbs=array(
	'Packages'=>array('index'),
	'Manage',
);
?>

<h1>Manage Packages</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'package-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'price_per_month',
		'discount',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
