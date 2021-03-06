<?php

// Saca lista de clientes associados � reserva
foreach($model->bookingGuest as $guest)
{
	$guestDetails = Guest::model()->findByPk($guest->id_guest);
	$guestList .= CHtml::link(CHtml::encode($guestDetails->name),array('guest/view','id'=>$guestDetails->id)) . ' ';
	$guestName = CHtml::encode($guestDetails->name);
}

$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	$guestName,
);

$this->menu=array(
array('label'=>'Update Booking', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete Booking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);

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

<h1>View Booking of <?php echo $guestList; ?></h1>

<?php
$paidValue = '';

if($model->paid == '0') $paidValue = 'Not Paid';
else					$paidValue = 'Paid';

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
	'attributes'=>array(
		array(  
				'label'=>'Room',
				'type'=>'raw',
				'value'=>CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/index','room'=>$model->id_room)),
		),
		'start_date',
		'night_num',
		array(  
				'label'=>'Bed Number',
				'type'=>'raw',
				'value'=>$model->bed_num,
		),
		'value',
		array( 
				'label'=>'Paid',
				'type'=>'raw',
				'value'=>$paidValue,
		),
		array( 
				'label'=>'State',
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
/*
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
}*/
?>
