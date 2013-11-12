<?php $this->breadcrumbs=array(
	Yii::t('contentForm','GUESTS')=>array('admin'),
	Yii::t('contentForm','SOLD_BEDS'),
); ?>

<h1><?php echo Yii::t('contentForm','CREATE_GUEST'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>