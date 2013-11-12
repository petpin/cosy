<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','EMPLOYEES'),
);
?>

<h1>Yii::t('contentForm','EMPLOYEES')</h1>

<div class="portlet-decoration">
    <div class="portlet-title">
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Create Employee',array('employee/create')); ?>
        </span>
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Manage Employees',array('employee/admin')); ?>
        </span>
    </div>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
