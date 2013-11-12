<div style="float: left; width: 50%;">
	<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	    'data'=>$model,
	    'type'=>'bordered',
	    'attributes'=>array(
	    	'start_date',
	        array(
	            'label'=>Yii::t('contentForm','ROOM'),
	            'type'=>'raw',
	            'value'=>CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/roomView', 'room'=>$model->id_room, 'month'=>date("m", strtotime($model->start_date)), 'year'=>date("Y", strtotime($model->start_date)))),
	        ),
	        array(
	           'name' => 'night_num',
	        ),
	        array(
	           'label'=>Yii::t('contentForm','Total Price'),
	           'type'=>'raw',
	           'value' => $totalValueToPay . " " . Yii::t('contentForm','EUR'),
	        ),
	        //'value',
	        array( 
	            'label'=>Yii::t('contentForm','PAID'),
	            'type'=>'raw',
	            'value'=>$paidValue,
	        ),
	        array( 
	            'label'=>Yii::t('contentForm','STATE'),
	            'type'=>'raw',
	            'value'=>$model->bookingState->description,
	        ),
	        'booking_date',
	    ),
	));?>
</div>

<div style="float: right; width: 45%;">
	<b><?php echo Yii::t('contentForm','DETAILS'); ?>:</b><br /><br />
	<?php echo nl2br(BookingDetails::model()->findByPk($model->id)->comments); ?>
</div>