<?php $this->breadcrumbs=array(
    Yii::t('contentForm','BOOKINGS')=>array('admin'),
    Yii::t('contentForm','MANAGE'),
); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
        /*array(
            'name' => 'client_name',
            //'value' => '$data->bookingGuest->guest->name',
            'value' => array($this,'gridGuestNameColumn'),
        ),*/
        array(
	        'name'=>'client_name',
	        'value'=>array($this,'renderButtons'),	//call the function 'renderButtons' from the current controller
	    ),
        array(
            'name' => 'roomTitle',
            'value' => array($this,'gridRoomNameColumn'),
            'filter' => CHtml::listData(Room::model()->findAll(), 'title', 'title'),
        ),
        'booking_date',
        /*array(
        	'class' => 'editable.EditableColumn',
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
                    'dateFormat' => 'yy-mm-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true), // (#4)
            'editable' => array(    //editable section
           		'type'       => 'date',
				'url'        => $this->createUrl('booking/updateEditable'),
				'placement'  => 'right',
			)
        ),*/
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'night_num',
           'editable' => array(
				'url'        => $this->createUrl('booking/updateEditable'),
				'placement'  => 'right',
			),
			'htmlOptions'=>array('style'=>'width: 120px'),
        ),
        array(
           'name' => 'bedNumberCount',
			'htmlOptions'=>array('style'=>'width: 80px'),
        ),
		array(
           'class' => 'editable.EditableColumn',
           'name' => 'value',
           'editable' => array(
				'url'        => $this->createUrl('booking/updateEditable'),
				'placement'  => 'right',
			),
			'htmlOptions'=>array('style'=>'width: 80px'),
        ),
        array(
            'name' => 'paid',
            'value' => array($this,'gridPaidDescription'),
            'filter' => array(1=>Yii::t('contentForm','PAID'), 0=>Yii::t('contentForm','NOT_PAID')),
            'htmlOptions'=>array('style'=>'width: 100px'),
        ),
        array(
            'name' => 'stateDescription',
            'value' => '$data->bookingState->description',
            'filter' => CHtml::listData(BookingState::model()->findAll(), 'description', 'description'),
        ),
        array(
        	'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>

<?php /*echo CHtml::ajaxSubmitButton('Delete',
	array('controller/action','act'=>'doDelete'), 
	array('beforeSend'=>'function() { if(confirm("Are You Sure ...")) return true; return false; }', 'success'=>'reloadGrid')
);*/ ?>