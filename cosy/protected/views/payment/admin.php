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
