<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','COUNTRIES')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
	array('label'=>'Update Country', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Country', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('contentForm','CONFIRM_DELETE_ITEM'))),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','VIEW_COUNTRY'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
	),
)); ?>
