<?php
$this->breadcrumbs=array(
	Yii::t('contentForm', 'Services')=>array('admin'),
	Yii::t('contentForm', 'Manage'),
);
?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'service-grid',
	'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
	'columns'=>array(
    
		array(
	       'class' => 'editable.EditableColumn',
	       'name' => 'name',
	       'editable' => array(
				'url'        => $this->createUrl('Service/updateEditable'),
				'placement'  => 'right',
			),
	    ),
	    
	    array(
	       'class' => 'editable.EditableColumn',
	       'name' => 'description',
	       'editable' => array(
	       		'type'		 => 'textarea',
				'url'        => $this->createUrl('Service/updateEditable'),
				'placement'  => 'right',
			),
	    ),
	    
	    array(
	       'class' => 'editable.EditableColumn',
	       'name' => 'price',
	       'editable' => array(
				'url'        => $this->createUrl('Service/updateEditable'),
				'placement'  => 'right',
			),
	    ),
    
		array(
	       'name' => 'creation_date',
	    ),
    
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}'
		),
	),
)); ?>
