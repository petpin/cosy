<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEE_TYPES')=>array('index'),
	$model->description,
);

$this->menu=array(
	array('label'=>'List EmployeeType', 'url'=>array('index')),
	array('label'=>'Create EmployeeType', 'url'=>array('create')),
	array('label'=>'Update EmployeeType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmployeeType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('contentForm','CONFIRM_DELETE_ITEM'))),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','VIEW_EMPLOYEE_TYPE'); ?> <?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		
		'description',
	),
)); ?>
