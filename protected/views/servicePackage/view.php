<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','Service Packages')=>array('admin'),
	$model->id_service,
);

?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("Service Package/admin"),
)); ?>

<h2><?phpYii::t('contentForm','View'); ?> ServicePackage - <?php echo $model->Array; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'id_service',
		'id_package',
		'creation_date',
	),
)); ?>
