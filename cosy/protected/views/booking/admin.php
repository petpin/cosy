<?php
$this->breadcrumbs=array(
    'Bookings'=>array('index'),
    'Manage',
);
?>

<h1>Manage Bookings</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'booking-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'name' => 'client_name',
            /*'value' => '$data->bookingGuest->guest->name',*/
            'value' => array($this,'gridGuestNameColumn'),
        ),
        array(
            'name' => 'roomTitle',
            'value' => array($this,'gridRoomNameColumn'),
        ),
        //'booking_date',
        'start_date',
        'night_num',
		'bedNumberCount',
        'value',
        array(
            'name' => 'paid',
            'value' => array($this,'gridPaidDescription'),
        ),
        array(
            'name' => 'stateDescription',
            'value' => '$data->bookingState->description',
        ),
        array(
            'header'=>'Options',
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
