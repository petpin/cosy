<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEE_TYPES')=>array('admin'),
	$model->description=>array('view','description'=>$model->description),
	Yii::t('contentForm','UPDATE'),
);
?>

<!--<h1><?php echo Yii::t('contentForm','UPDATE_EMPLOYEE_TYPE'); ?> <?php echo $model->description; ?></h1>-->

<br><br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>