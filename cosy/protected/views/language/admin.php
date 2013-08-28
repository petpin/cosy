<?php
$this->breadcrumbs=array(
	'Languages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Language', 'url'=>array('index')),
	array('label'=>'Create Language', 'url'=>array('create')),
);
?>

<h1>Manage Languages</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'language-grid',
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
