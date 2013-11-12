<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEES')=>array('admin'),
	Yii::t('contentForm','CREATE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employee/admin", array('id'=>$model->id)),
)); ?>

<!--<h3><?php echo Yii::t('contentForm','CREATE_EMPLOYEE'); ?></h3>-->

<br><br>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>