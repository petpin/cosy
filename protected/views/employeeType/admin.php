<?php
$this->breadcrumbs=array(
    Yii::t('contentForm','EMPLOYEE_TYPES')=>array('admin'),
    Yii::t('contentForm','MANAGE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employeeType/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'employeeTypeGrid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
    	array(
           'class' => 'editable.EditableColumn',
           'name' => 'description',
           'editable' => array(    //editable section
				'url'        => $this->createUrl('employeeType/updateEditable'),
				'placement'  => 'right',
			),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}'
        ),
    ),
)); ?>
