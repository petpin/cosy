<?php
$this->breadcrumbs=array(
    'Guests'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Guest', 'url'=>array('index')),
    array('label'=>'Create Guest', 'url'=>array('create')),
);
?>

<h1>Manage Guests</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'guest-grid',
    'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        'email',
        'phone',
        array(
            'name' => 'languageDescription',
            'value' => '$data->language->description',
        ),
        array(
            'name' => 'countryName',
            'value' => '$data->country->name',
        ),
        array(
            'header'=>'Options',
            'class'=>'CButtonColumn',
        ),
    ),
));
?>
