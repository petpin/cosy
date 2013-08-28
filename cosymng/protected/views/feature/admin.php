<?php
$this->breadcrumbs=array(
	'Features'=>array('admin'),
	'Manage',
);
?>

<h1>Manage Features</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'features-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'yii_mvc',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
