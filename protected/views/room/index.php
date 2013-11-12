<?php
$this->breadcrumbs=array(
	Yii::t('contentForm', 'ROOMS'),
);

$this->menu=array(
	array('label'=>'Create Room', 'url'=>array('create')),
	array('label'=>'Manage Room', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm', 'ROOMS'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
