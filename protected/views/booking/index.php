<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKINGS'),
);

$this->menu=array(
array('label'=>'Manage Booking', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('contentForm','BOOKINGS'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
