<?php
// Saca lista de clientes associados � reserva
foreach($model->bookingGuest as $guest)
{
    $guestList .= CHtml::link(CHtml::encode($guest->guest->name),array('guest/view','id'=>$guest->guest->id)) . ' ';
    $guestName = CHtml::encode($guest->guest->name);
}

$model->id_supplier = $model->bookingDays[0]->id_supplier;
$model->id_room = $model->bookingDays[0]->id_room;

?>

<h1>View Booking of <?php echo $guestList; ?></h1>

<?php
$paidValue = '';

if($model->paid == '0') $paidValue = 'Not Paid';
else			$paidValue = 'Paid';

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
        'value',
        array( 
            'label'=>'Paid',
            'type'=>'raw',
            'value'=>$paidValue,
        ),
        array( 
            'label'=>'State',
            'type'=>'raw',
            'value'=>$model->bookingState->description,
        ),
        'booking_date',
    ),
));

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
