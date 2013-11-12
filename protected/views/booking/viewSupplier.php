<?php Yii::app()->session['bookingViewTab'] = 'linkBookingTab4'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'type'=>'bordered',
    'attributes'=>array(
    	'name',
    	'rate_value',
    	array(
            'label'=>'Retained Value',
            'type'=>'raw',
            'value'=>$retainedValueEur,
        ),
	),
)); ?>