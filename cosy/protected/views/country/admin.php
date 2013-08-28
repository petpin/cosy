<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Country', 'url'=>array('index')),
	array('label'=>'Create Country', 'url'=>array('create')),
);
?>

<h1>Manage Countries</h1>

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
