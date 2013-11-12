<?php
// Saca lista de clientes associados ˆ reserva
foreach($model->bookingGuest as $guest)
{
	$guestDetails = Guest::model()->findByPk($guest->id_guest);
	$guestName = CHtml::encode($guestDetails->name);
	$guestEmail = CHtml::encode($guestDetails->email);
}

/*
 *	Associa os campos de outras entidades (Guest, Room) ao Booking
 */
$model->client_name = $guestName;
$model->client_email = $guestEmail;

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

<?php
if(isset($error)) echo '<span class="required">' . $error . '</span>';

echo $this->renderPartial('_form', array('model'=>$model));
?>