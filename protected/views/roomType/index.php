<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOM_TYPES'),
);

$this->menu=array(
	array('label'=>'Create RoomType', 'url'=>array('create')),
	array('label'=>'Manage RoomType', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','ROOM_TYPES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
