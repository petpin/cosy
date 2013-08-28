<?php
$this->breadcrumbs=array(
	'Rooms'=>array('admin'),
	'Manage',
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("room/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'room-grid',
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'title',
        array( 
            'name'=>'roomTypeDescription',
            'value'=>'$data->roomType->description',
        ),
        'bed_num',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); ?>
