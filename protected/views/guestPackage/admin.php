<?php
$this->breadcrumbs=array(
	Yii::t('contentForm', 'Guest Packages')=>array('admin'),
	Yii::t('contentForm', 'Manage'),
);
?>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success',
    'url'=>Yii::app()->createUrl("room/create"),
));?>

<h2>Manage Guest Packages</h2>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'guest-package-grid',
	'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
	'columns'=>array(
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'id_booking',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Guest Package/updateEditable'),
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
			'url'        => $this->createUrl('Guest Package/updateEditable'),
			'placement'  => 'right',
			//'type'     => 'select',
			//'source'   => CHtml::listData(Example::model()->findAll(), 'id', 'value'),
		),
    ),
    
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'create_date',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Guest Package/updateEditable'),
			'placement'  => 'right',
			//'type'     => 'select',
			//'source'   => CHtml::listData(Example::model()->findAll(), 'id', 'value'),
		),
    ),
    
			array(
       'class' => 'editable.EditableColumn',
       'name' => 'last_update_date',
       //'filter'=>CHtml::listData(Example::model()->findAll(), 'id', 'value'),
       'editable' => array(    //editable section
			'url'        => $this->createUrl('Guest Package/updateEditable'),
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
