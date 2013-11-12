<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','SUPPLIERS') =>array('admin'),
	Yii::t('contentForm','MANAGE'),
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','CREATE'),
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("supplier/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'supplier-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        //'id',
        'name',
        'url',
        'rate_value',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
