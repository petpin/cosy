<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','COUNTRIES')=>array('index'),
	Yii::t('contentForm','MANAGE'),
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
);
?>

<h1><?php echo Yii::t('contentForm','MANAGE_COUNTRIES'); ?></h1>

<div class="portlet-decoration">
    <div class="portlet-title">
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Create Country',array('employee/create')); ?>
        </span>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'country-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
            'name',
            array(
                    'class'=>'CButtonColumn',
            ),
    ),
)); ?>
