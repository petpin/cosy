<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','GUESTS'),
);

$this->menu=array(
	array('label'=>Yii::t('contentForm','CREATE_GUEST'), 'url'=>array('create')),
	array('label'=>Yii::t('contentForm','MANAGE_GUEST'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','GUESTS'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
