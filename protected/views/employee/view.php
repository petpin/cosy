<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEE')=>array('admin'),
	Yii::t('contentForm','VIEW') . " - " . $model->name . " " . $model->surname,
);
?>

<div style="padding-left: 40px;">

	<h2><?php $this->widget('editable.EditableField', array(
		'type'      => 'text',
		'model'     => $model,
		'attribute' => 'name',
		'url'       => $this->createUrl('employee/updateEditable'), 
		'placement' => 'right',
	)); ?> <?php $this->widget('editable.EditableField', array(
		'type'      => 'text',
		'model'     => $model,
		'attribute' => 'surname',
		'url'       => $this->createUrl('employee/updateEditable'), 
		'placement' => 'right',
	)); ?>
	</h2>
	<h5>
	
	<b><?php echo Yii::t('contentForm','PHONE'); ?>:</b> <?php $this->widget('editable.EditableField', array(
		'type'      => 'text',
		'model'     => $model,
		'attribute' => 'phone',
		'url'       => $this->createUrl('employee/updateEditable'), 
		'placement' => 'right',
	)); ?>
	
	<br />
	
	<b><?php echo Yii::t('contentForm','EMAIL'); ?>:</b> <?php $this->widget('editable.EditableField', array(
		'type'      => 'text',
		'model'     => $model,
		'attribute' => 'email',
		'url'       => $this->createUrl('employee/updateEditable'), 
		'placement' => 'right',
	)); ?>
	
	<br />
	
	<b><?php echo Yii::t('contentForm','EMPLOYEE_TYPE_NAME'); ?>:</b> <?php $this->widget('editable.EditableField', array(
        'type'      => 'select',
        //'text'		=> 'Tipo de funcionario',
        'model'     => $model,
        'attribute' => 'id_employee_type',
        'source'    => Editable::source(EmployeeType::model()->findAll(), 'id', 'description'),
        //you can also use js function returning string url
        //'source'    => 'js: function() { return "?r=site/getStatusList"; }',
        'apply'     => '$data->id_employee_type != 1', //can't edit deleted users
        'url'       => $this->createUrl('employee/updateEditable'), 
        'placement' => 'right',
    )); ?>
	
	<br />
	
	</h5>

</div>
