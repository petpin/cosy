<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','SUPPLIERS')=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('contentForm','UPDATE'),
);
?>

<h1><?php echo Yii::t('contentForm','UPDATE_SUPPLIER'); ?> <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>