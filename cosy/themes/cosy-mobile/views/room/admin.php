<?php
$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Room', 'url'=>array('index')),
	array('label'=>'Create Room', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('room-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rooms</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'room-grid',
	'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'bed_num',
		array(  // related state displayed as a link
	        'header'=>'Type',
			'value'=>'$data->roomType->description',
	        //'value'=>RoomType::model()->findByPk( $data->id_type )->description,
		),
		array(
			'header'=>'Options',
			'class'=>'CButtonColumn',
		),
	),
)); ?>
