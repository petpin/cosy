<?php
$this->breadcrumbs=array(
    'Employees'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Employee', 'url'=>array('index')),
    array('label'=>'Create Employee', 'url'=>array('create')),
);
?>

<h1>Manage Employees</h1>

<div class="portlet-decoration">
    <div class="portlet-title">
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Create Employee',array('employee/create')); ?>
            <?php echo Yii::t('pt.yii', 'Description'); ?>
            <?php echo CHtml::button('Create Employee',array('employee/create')); ?>
        </span>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'employee-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name', 'surname', 'phone', 'email', 
        array(
            'name' => 'employeeTypeName',
            'value' => '$data->employeeType->description',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>