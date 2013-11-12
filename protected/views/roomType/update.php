<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOM_TYPE')=>array('admin'),
	$model->description=>array('view','description'=>$model->description),
	Yii::t('contentForm','UPDATE'),
);
?>

<h2><?php echo Yii::t('contentForm','UPDATE_ROOM_TYPE'); ?> <?php echo $model->description; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>