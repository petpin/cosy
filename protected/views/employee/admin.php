<?php
$this->breadcrumbs=array(
    Yii::t('contentForm','EMPLOYEES')=>array('admin'),
    Yii::t('contentForm','MANAGE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employee/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'employee-type-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
    	array(
           'class' => 'editable.EditableColumn',
           'name' => 'name',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('employee/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'surname',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('employee/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'phone',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('employee/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'email',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('employee/updateEditable'),
				'placement'  => 'right',
			),
        ), 
        array(
        	//'class' => 'editable.EditableColumn',
            'name' => 'employeeTypeName',
            'value' => '$data->employeeType->description',
            'filter' => CHtml::listData(EmployeeType::model()->findAll(), 'description', 'description'),
            /*'editable' => array(    //editable section
				'type'     => 'select',
				'url'      => $this->createUrl('employee/updateEditable'),
				'source'   => CHtml::listData(EmployeeType::model()->findAll(), 'description', 'description'),
				'placement'  => 'right',
			)*/
        ),
        array(
        	'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}'
        ),
    ),
)); ?>