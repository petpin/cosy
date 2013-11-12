<?php

// Saca lista de clientes associados  reserva
foreach($model->bookingGuest as $guest)
{
	$guestDetails = Guest::model()->findByPk($guest->id_guest);
	$guestList .= CHtml::link(CHtml::encode($guestDetails->name),array('guest/view','id'=>$guestDetails->id)) . ' ';
	$guestName = CHtml::encode($guestDetails->name);
}

/*
 * Saca o primeiro registo na tabela Booking_Day
 */
$criteria = new CDbCriteria;
$criteria->condition='id_booking=:id_booking AND day=:start_date';
$criteria->params=array(':id_booking'=>$model->id, ':start_date'=>$model->start_date);

$bookingDays = BookingDays::model()->findAll($criteria);

foreach($bookingDays as $bookingDay)
{
	$model->id_supplier = $bookingDay->id_supplier;
	$model->bed_num = $bookingDay->bed_num;
	$model->id_room = $bookingDay->id_room;
}
?>

<h1><?php echo Yii::t('contentForm','BOOKING');?> :: <?php echo $guestList; ?></h1>

<?php
$paidValue = '';

if($model->paid == '0') $paidValue = Yii::t('contentForm','NOT_PAID');
else					$paidValue = Yii::t('contentForm','PAID');

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(  
				'label'=>Yii::t('contentForm','ROOM'),
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/index','room'=>$model->id_room)),
		),
		'start_date',
		'night_num',
		array(  
				'label'=>Yii::t('contentForm','BED_NUMBER'),
				'type'=>'raw',
				'value'=>$model->bed_num,
		),
		'value',
		array( 
				'label'=>Yii::t('contentForm','PAID'),
				'type'=>'raw',
				'value'=>$paidValue,
		),
		array( 
				'label'=>Yii::t('contentForm','STATE'),
				'type'=>'raw',
				'value'=>BookingState::model()->findByPk($model->id_state)->description,
		),
		'booking_date',
	),
));

// Saca lista de bookings associados ao guest e guardo no array $bookingDetails
foreach($model->bookingDays as $day)
{	
	$dayDetails[] = array($day->day, $day->price, Supplier::model()->findByPk($day->id_supplier)->name);
}

if(count($dayDetails) > 0)
{
	?>
	<br />
	<?php
	
	$columnsArray = array('Day','Price','Supplier');
	$rowsArray = $dayDetails;
	 
	$this->widget('ext.htmlTableUi.htmlTableUi',array(
	    'collapsed'=>false,
	    'enableSort'=>true,
		'extra'=>null,
	    'sortColumn'=>1,
	    'sortOrder'=>'desc',
	 	'editable'=>true,
	    'title'=>'Booking Days',
	    'columns'=>$columnsArray,
	    'rows'=>$rowsArray,
	    'footer'=>'Total rows: '.count($rowsArray),
		'cssFile'=>'/css/ui-lightness/jquery-ui-1.8.18.custom.css'
	));
}
?>
