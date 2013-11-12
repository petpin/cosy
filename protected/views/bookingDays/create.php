<?php
$this->breadcrumbs=array(
    Yii::t('contentForm','BOOKING_DAYS') =>array('admin'),
    Yii::t('contentForm','CREATE'),
);
?>

<h1><?php echo Yii::t('contentForm','CREATE_BOOKING_DAYS'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>