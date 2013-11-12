<?php
// Saca lista de quartos associados ˆ reserva
foreach($data->bookingDays as $day)
{
	$daysList[] = array('id_room'=>$day->id_room, 'bed_num'=>$day->bed_num);
}
// Saca lista de clientes associados ˆ reserva
foreach($data->bookingGuest as $guest)
{
	$guestList .= Guest::model()->findByPk($guest->id_guest)->name;
}
?>
<div class="view">

	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Guest')); ?>:</b> 
	<?php echo  CHtml::encode($guestList); ?>
	</div>
	
	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_room')); ?>:</b>
	<?php echo CHtml::encode(Room::model()->findByPk($daysList[0]['id_room'])->title); ?>
	</div>
	
	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('booking_date')); ?>:</b>
	<?php echo CHtml::encode($data->booking_date); ?>
	</div>	
	
	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	</div>
	
	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('night_num')); ?>:</b>
	<?php echo CHtml::encode($data->night_num); ?>
	</div>
	
	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('bed_num')); ?>:</b>
	<?php echo CHtml::encode($daysList[0]['bed_num']); ?>
	</div>
	
	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('value')); ?>:</b>
	<?php echo CHtml::encode(Booking::model()->convertDotToComma($data->value)); ?>
	</div>
	
	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Payment')); ?>:</b>
	<?php 
	if($data->paid == '0') 	$paidValue = '<span style="color:red;">'.Yii::t('contentForm','NOT_PAID').'</span>';
	else					$paidValue = '<span style="color:green;">'.Yii::t('contentForm','PAID').'</span>';
	
	echo $paidValue;
	?>
	</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('State')); ?>:</b>
	<?php echo CHtml::encode(BookingState::model()->findByPk($data->id_state)->description); ?>
	<br />
	
</div>