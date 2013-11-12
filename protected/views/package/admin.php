<?php
$this->breadcrumbs=array(
	Yii::t('contentForm', 'Packages')=>array('admin'),
	Yii::t('contentForm', 'Manage'),
);
?>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success',
    'url'=>Yii::app()->createUrl("package/create"),
));?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'package-grid',
	'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
	'columns'=>array(
    
		array(
	       'class' => 'editable.EditableColumn',
	       'name' => 'name',
	       'editable' => array(    //editable section
				'url'        => $this->createUrl('Package/updateEditable'),
				'placement'  => 'right',
			),
	    ),
    
		array(
	       'class' => 'editable.EditableColumn',
	       'name' => 'description',
	       'editable' => array(    //editable section
	       		'type'		 => 'textarea',
				'url'        => $this->createUrl('Package/updateEditable'),
				'placement'  => 'right',
			),
	    ),
    
		array(
	       'name' => 'creation_date',
	    ),
    
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}'
		),
	),
)); ?>
