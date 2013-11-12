<?php
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
);
?>

<h1>Manage Payments</h1>

<div class="portlet-decoration">
    <div class="portlet-title">
        <span class="icon icon-sitemap_color" style="width: auto; color:white;">
            <?php echo CHtml::link('Create Payment',array('create')); ?>
        </span>
    </div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'payment-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
            'description',
            array(
                    'class'=>'CButtonColumn',
            ),
    ),
)); ?>
