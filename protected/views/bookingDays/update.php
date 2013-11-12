<?php $this->breadcrumbs=array(
	Yii::t('contentForm','BOOKING_DAYS')=>array('admin'),
	$model->id_booking=>array('view', 'id_booking'=>$model->id_booking, 'day'=>$model->day),
	Yii::t('contentForm','UPDATE'),
); ?>

<h1><?php echo Yii::t('contentForm','UPDATE_DAY');?> <?php echo $model->day; ?> <?php echo Yii::t('contentForm','OF_BOOKING');?> <?php echo $model->id_booking; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>