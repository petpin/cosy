<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','COUNTRIES')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('contentForm','UPDATE'),
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
	array('label'=>'View Country', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Country', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','UPDATE_COUNTRY'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>