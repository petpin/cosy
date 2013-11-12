<?php
$this->breadcrumbs=array(
	'Services',
);

?>

<h2>Services</h2>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
