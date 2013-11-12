<?php
$this->breadcrumbs=array(
	'Service Packages',
);

?>

<h2>Service Packages</h2>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
