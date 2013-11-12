<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','SUPPLIERS'),
);
?>

<h1><?php echo Yii::t('contentForm','SUPPLIERS'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
