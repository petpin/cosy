<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','SUPPLIERS')=>array('admin'),
	$model->name,
);
?>

<h1><?php echo Yii::t('contentForm','VIEW_SUPPLIER'); ?> <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'url',
		'rate_value',
	),
)); ?>
