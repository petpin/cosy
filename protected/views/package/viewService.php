<?php Yii::app()->session['packageViewTab'] = 'linkPackageTab2'; ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>Yii::t('contentForm','Add Service'),
    'type'=>'info',
    'size'=>'small',
    'icon'=>'plus white',
    'url'=>"javascript:viewCreateServicePackageForm('$model->id', 'serviceForm');",
)); ?>

<div id="serviceForm" style="padding-top: 10px;"></div>

<?php 
$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
));
Yii::app()->user->setFlash('error', '<strong>Oh snap!</strong> Change a few things up and try submitting again.');
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'servicePackageGrid',
    'type'=>'striped condensed',
    'dataProvider'=>$servicesList,
    'template' => "{items}\n{summary}\n{pager}",
    'pagerCssClass'=>'pagination pagination-centered',
    'enableSorting' => false,
    'columns'=>array(
    	array(
            'name' => 'service',
            'value' => '$data->service->name',
        ),
        array(
            'name' => 'price',
            'value' => '$data->service->price',
        ),
        array(
            'header'=>'Remove',
            'type'=>'raw',
            'value'=>'CHtml::Button("Remove",array("class"=>"btn btn-warning btn-small", "onclick"=>"javascript:deassociateServicePackage(\'$data->id_package\', \'$data->id_service\', \'serviceForm\', \'\');"))',
        ),
    ),
)); ?>