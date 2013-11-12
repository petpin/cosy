<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEE_TYPES'),
);

$this->menu=array(
	array('label'=>'Create EmployeeType', 'url'=>array('create')),
	array('label'=>'Manage EmployeeType', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','EMPLOYEE_TYPES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
