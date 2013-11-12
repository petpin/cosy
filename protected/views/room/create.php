<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOMS')=>array('admin'),
	Yii::t('contentForm','CREATE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("room/admin"),
)); ?>

<!--<h3><?php echo Yii::t('contentForm','CREATE_ROOM'); ?></h3>-->

<br><br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>