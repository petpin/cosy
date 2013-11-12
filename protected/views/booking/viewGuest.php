<?php Yii::app()->session['bookingViewTab'] = 'linkBookingTab3'; ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>Yii::t('contentForm','ADD_GUEST'),
    'type'=>'info',
    'size'=>'small',
    'icon'=>'plus white',
    'url'=>'javascript:viewCreateGuest("' . $model->id . '", "guestForm");',//Yii::app()->createUrl("guest/create" . "&idBooking=" . $model->id),
)); ?>

<div id="guestForm" style="padding-top: 10px;"></div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'roomGuestGrid',
    'type'=>'striped condensed',
    'dataProvider'=>$guestsList,
    'template' => "{items}\n{summary}\n{pager}",
    'pagerCssClass'=>'pagination pagination-centered',
    'enableSorting' => false,
    'columns'=>array(
    	array(
            'name' => 'guest',
            'value' => '$data->guest->name',
        ),
        array(
            'name' => 'email',
            'value' => '$data->guest->email',
        ),
        array(
        	'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'view'=>
                    array(
                        'url'=>'Yii::app()->createUrl("guest/view", array("id"=>$data->guest->id))',
                    ),
                /*'update'=>
                    array(
                		'url' => 'array("bookingDays/update", "id_booking"=>$data->id_booking, "day"=>$data->day)',
                	),
                'deleteButtonUrl' => 'array("bookingDays/delete", "id_booking"=>$data->id_booking, "day"=>$data->day)',*/
            ),
        ),
    ),
)); ?>