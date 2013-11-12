<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_STATES')=>array('index'),
	$model->description=>array('view','description'=>$model->description),
	Yii::t('contentForm','UPDATE'),
);

$this->menu=array(
	array('label'=>'List BookingState', 'url'=>array('index')),
	array('label'=>'Create BookingState', 'url'=>array('create')),
	array('label'=>'View BookingState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookingState', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','UPDATE_BOOKING_STATE'); ?> <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>