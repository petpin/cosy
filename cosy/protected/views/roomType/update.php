<?php
$this->breadcrumbs=array(
	'Room Types'=>array('index'),
	$model->description=>array('view','description'=>$model->description),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoomType', 'url'=>array('index')),
	array('label'=>'Create RoomType', 'url'=>array('create')),
	array('label'=>'View RoomType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RoomType', 'url'=>array('admin')),
);
?>

<h1>Update Room Type <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>