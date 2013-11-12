<?php
$this->breadcrumbs=array(
	'Suppliers',
);
?>

<h1>Suppliers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
