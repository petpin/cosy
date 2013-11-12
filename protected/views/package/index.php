<?php
$this->breadcrumbs=array(
	'Packages',
);

?>

<h2>Packages</h2>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
