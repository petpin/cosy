<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'roomDaysGrid',
    'dataProvider'=>$bookingDays,
    'template' => "{items}\n{summary}\n{pager}",
    'pagerCssClass'=>'pagination pagination-centered',
    'enableSorting' => false,
    'columns'=>array(
        'day',
        'price',
		'bed_num',
        'Room.title',
        array(
        	'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            /*'buttons'=>array(
                'view'=>
                    array(
                        'url'=>'Yii::app()->createUrl("bookingDays/view", array("id_booking"=>$data->id_booking, "day"=>$data->day))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }'
                            ),
                        ),
                    ),
                'update'=>
                    array(
                		'url' => 'array("bookingDays/update", "id_booking"=>$data->id_booking, "day"=>$data->day)',
                	),
                'deleteButtonUrl' => 'array("bookingDays/delete", "id_booking"=>$data->id_booking, "day"=>$data->day)',
            ),*/
        ),
    ),
)); ?>