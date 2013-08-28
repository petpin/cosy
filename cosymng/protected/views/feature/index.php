<?php
$this->breadcrumbs=array(
	'Features',
);

$this->menu=array(
	array('label'=>'Create Features', 'url'=>array('create')),
	array('label'=>'Manage Features', 'url'=>array('admin')),
);
?>

<h1>Features</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
