<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','COUNTRIES'),
);

$this->menu=array(
	array('label'=>'Create Country', 'url'=>array('create')),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','COUNTRIES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
