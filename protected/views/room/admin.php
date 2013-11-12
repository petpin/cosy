<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','ROOMS')=>array('admin'),
	Yii::t('contentForm','MANAGE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success',
    'url'=>Yii::app()->createUrl("room/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'room-grid',
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
    	array(
           'class' => 'editable.EditableColumn',
           'name' => 'title',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('room/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
        	'class' => 'editable.EditableColumn',
            'name'=>'roomTypeDescription',
            'value'=>'$data->roomType->description',
            'filter'=>CHtml::listData(RoomType::model()->findAll(), 'description', 'description'),
			'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				'type'     => 'select',
				'url'      => $this->createUrl('room/updateEditable'),
				'source'   => CHtml::listData(RoomType::model()->findAll(), 'description', 'description'),
				'placement'  => 'right',
			)   
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'bed_num',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('room/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}'
        ),
    ),
)); ?>
