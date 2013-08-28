<?php $this->breadcrumbs=array(
    'Bookings'=>array('admin'),
    'Manage',
); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
)); ?>

<!--<h1>Manage Bookings</h1>-->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
        array(
            'name' => 'client_name',
            /*'value' => '$data->bookingGuest->guest->name',*/
            'value' => array($this,'gridGuestNameColumn'),
        ),
        /*array(
            'name' => 'roomTitle',
            'value' => array($this,'gridRoomNameColumn'),
            'filter' => CHtml::listData(Room::model()->findAll(), 'title', 'title'),
        ),*/
        //'booking_date',
        array(
            'name' =>'start_date',
        	'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'start_date', 
                'language' => 'ja',
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true), // (#4)
        ),
        'night_num',
		'bedNumberCount',
        'value',
        /*array(
            'name' => 'supplierName',
            'value' => '$data->supplier->name',
            'filter' => CHtml::listData(Supplier::model()->findAll(), 'name', 'name'),
        ),*/
        array(
            'name' => 'paid',
            'value' => array($this,'gridPaidDescription'),
            'filter' => array(1=>'Paid', 0=>'Not Paid'),
        ),
        array(
            'name' => 'stateDescription',
            'value' => '$data->bookingState->description',
            'filter' => CHtml::listData(BookingState::model()->findAll(), 'description', 'description'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>