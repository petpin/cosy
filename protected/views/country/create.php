<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','COUNTRIES')=>array('index'),
	Yii::t('contentForm','CREATE'),
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','CREATE_COUNTRY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>