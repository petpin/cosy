<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOMS')=>array('admin'),
	$model->title,
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("room/admin"),
)); ?>

<h2><?php echo Yii::t('contentForm','VIEW_ROOM'); ?> <?php echo $model->title; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'title',
		'bed_num',
		array(  // related state displayed as a link
		            'label'=>Yii::t('contentForm','TYPE'),
		            'type'=>'raw',
		            'value'=>RoomType::model()->findByPk( $model->id_type )->description,
		),
	),
)); ?>