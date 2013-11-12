<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','SUPPLIERS')=>array('admin'),
	Yii::t('contentForm','CREATE'),
);
?>

<h1><?php echo Yii::t('contentForm','CREATE_SUPPLIER'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>