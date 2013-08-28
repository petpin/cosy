<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'Update Employee', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Employee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>

<h1>View Employee <?php echo $model->name; ?></h1>

<div class="portlet-decoration">
    <div class="portlet-title">
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Create Employee',array('employee/create')); ?>
        </span>
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Update Employee', array('employee/update', 'id'=>$model->id)); ?>
        </span>
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('List Employees',array('employee/index')); ?>
        </span>
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Manage Employees',array('employee/admin')); ?>
        </span>
    </div>
</div>

<br />

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'surname',
		'phone',
		'email',
	),
)); ?>
