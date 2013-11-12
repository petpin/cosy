<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOMS')=>array('index'),
	$model->title=>array('view','title'=>$model->title),
	Yii::t('contentForm','UPDATE'),
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
	array('label'=>'View Room', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Room', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','UPDATE_ROOM'); ?> <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>