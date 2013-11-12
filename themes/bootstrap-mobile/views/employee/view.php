<?php
$this->breadcrumbs=array(
	'Employee'=>array('admin'),
	'View',
);
?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
		'surname',
		'phone',
		'email',
    ),
)); ?>
