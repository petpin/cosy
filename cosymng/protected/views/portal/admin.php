<?php
$this->breadcrumbs=array(
	'Portals'=>array('admin'),
	'Manage',
);
?>

<h1>Manage Portals</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'portal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'connection_string',
		'user_bd',
		'password_bd',
		array(
            'name'=>'stateName',
            'value'=>'$data->state->name',
        ),
		array(
            'name'=>'packageName',
            'value'=>'$data->package->name',
        ),
		'validity',
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->controller->createUrl("view",$data->primaryKey)',
			'updateButtonUrl'=>'Yii::app()->controller->createUrl("update",$data->primaryKey)',
			'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",$data->primaryKey)',
		),
	),
)); ?>
