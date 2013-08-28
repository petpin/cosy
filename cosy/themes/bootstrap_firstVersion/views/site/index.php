<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    //'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>

<?php
	// Vista por defeito
	//echo $this->renderPartial('roomView', array());
	echo $this->renderPartial('excelView', array());
?>

<?php $this->endWidget(); ?>


