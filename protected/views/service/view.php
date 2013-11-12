<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','Services')=>array('admin'),
	$model->name,
);

?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("Service/admin"),
)); ?>

<h2><?phpYii::t('contentForm','View'); ?> Service - <?php echo $model->name; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
		'price',
		'create_date',
	),
)); ?>
