<?php
$this->breadcrumbs=array(
	Yii::t('contentForm', 'Service Packages')=>array('admin'),
	Yii::t('contentForm', 'Manage'),
);

?>

<h2>Manage Service Packages</h2>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'service-package-grid',
	'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
	'columns'=>array(
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'id_service',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Service Package/updateEditable'),
			'placement'  => 'right',
			//'type'     => 'select',
			//'source'   => CHtml::listData(Example::model()->findAll(), 'id', 'value'),
		),
    ),
    
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'id_package',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Service Package/updateEditable'),
			'placement'  => 'right',
			//'type'     => 'select',
			//'source'   => CHtml::listData(Example::model()->findAll(), 'id', 'value'),
		),
    ),
    
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'creation_date',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Service Package/updateEditable'),
			'placement'  => 'right',
			//'type'     => 'select',
			//'source'   => CHtml::listData(Example::model()->findAll(), 'id', 'value'),
		),
    ),
    
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			//'template'=>'{view}{update}{delete}'
		),
	),
)); ?>
