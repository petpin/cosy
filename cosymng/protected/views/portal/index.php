<?php
$this->breadcrumbs=array(
	'Portals',
);

$this->menu=array(
	array('label'=>'Create Portal', 'url'=>array('create')),
	array('label'=>'Manage Portal', 'url'=>array('admin')),
);
?>

<h1>Portals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
