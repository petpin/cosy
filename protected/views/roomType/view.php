<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOM_TYPES')=>array('admin'),
	$model->description,
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("roomType/admin", array('id'=>$model->id)),
)); ?>

<h2><?php echo Yii::t('contentForm','VIEW_ROOM_TYPE'); ?> <?php echo $model->description; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'description',
	),
)); ?>
