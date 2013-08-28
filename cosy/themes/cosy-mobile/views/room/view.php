<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Update Room', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Room', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Room', 'url'=>array('admin')),
);
?>

<h1>View Room <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
	'attributes'=>array(
		'title',
		'bed_num',
		array(  // related state displayed as a link
		            'label'=>'Type',
		            'type'=>'raw',
		            'value'=>RoomType::model()->findByPk( $model->id_type )->description,
		),
	),
)); ?>