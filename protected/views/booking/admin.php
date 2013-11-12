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
    	array(
	        'name'=>'client_name',
	        'value'=>array($this,'renderButtons'),	//call the function 'renderButtons' from the current controller
	    ),
        'booking_date',
        array(
           	'name' => 'night_num',
        ),
        array(
           	'name' => 'bedNumberCount',
        ),
		array(
           	'name' => 'value',
        ),
        array(
        	'class' => 'editable.EditableColumn',
            'name' => 'paid',
            'value' => array($this,'gridPaidDescription'),
            'filter' => array(1=>Yii::t('contentForm','PAID'), 0=>Yii::t('contentForm','NOT_PAID')),
            'editable' => array(
            	'type'		=> 'select',
				'url'       => $this->createUrl('booking/updateEditable'),
				'source'    => array(1=>Yii::t('contentForm','PAID'), 0=>Yii::t('contentForm','NOT_PAID')),
				'placement' => 'right',
			),
        ),
        array(
        	'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>