<?php

$this->breadcrumbs=array(
    'Bookings'=>array('admin'),
    $guestName,
);

// Saca lista de clientes associados ? reserva
foreach($model->bookingGuest as $guest)
{
    $guestList .= CHtml::link(CHtml::encode($guest->guest->name),array('guest/view','id'=>$guest->guest->id)) . ' ';
    $guestName = CHtml::encode($guest->guest->name);
}

$model->id_supplier = $model->bookingDays[0]->id_supplier;
$model->id_room = $model->bookingDays[0]->id_room;

$paidValue = '';

if($model->paid == '0') $paidValue = 'Not Paid';
else			$paidValue = 'Paid';

?>

<div class="box-booking">
	<div class="inside">
		<div class="title">View Booking of <?php echo $guestList; ?></div><div class="icons"><a href="<?php echo Yii::app()->createUrl('booking/update', array('id' => $model->id)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-pen.png" alt="Update" /></a></div>
		<div class="clear"></div>
		<div class="details">
			<div class="item3"><b>Room:</b> <?php echo CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/index','room'=>$model->id_room)); ?></div>
			<div class="item3"><b>Start Date:</b> <?php echo $model->start_date; ?></div>
			<div class="item3"><b>Night Number:</b> <?php echo $model->night_num; ?></div>
			<div class="clear"></div>
			<div class="item3"><b>Total Paid:</b> <?php echo $model->value; ?></div>
			<div class="item3"><b>Payment State:</b> <?php echo $paidValue; ?></div>
			<div class="item3"><b>Booking State:</b> <?php echo $model->bookingState->description; ?></div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<br />
<h1 style="font-family: 'Philosopher', sans-serif; ">Booking Days</h1>
	
<?php

$dataProvider=new CActiveDataProvider('BookingDays', array(
    'criteria'=>array(
        'condition'=>'id_booking=:id_booking',
        'params'=>array(':id_booking'=>$model->id),
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'room-days-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'day',
        'price',
		'bed_num',
        'Room.title',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'viewButtonUrl' => 'array("bookingDays/view", "id_booking"=>$data->id_booking, "day"=>$data->day)',
            'updateButtonUrl' => 'array("bookingDays/update", "id_booking"=>$data->id_booking, "day"=>$data->day)',
            'deleteButtonUrl' => 'array("bookingDays/delete", "id_booking"=>$data->id_booking, "day"=>$data->day)',
        ),
    ),
));

?>
