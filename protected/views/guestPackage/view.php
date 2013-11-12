<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','Guest Packages')=>array('admin'),
	$model->id_booking,
);

?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("Guest Package/admin"),
)); ?>

<h2><?phpYii::t('contentForm','View'); ?> GuestPackage - <?php echo $model->Array; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		'id_booking',
		'id_package',
		'create_date',
		'last_update_date',
	),
)); ?>
