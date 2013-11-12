<?php Yii::app()->session['bookingViewTab'] = 'linkBookingTab5'; ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>Yii::t('contentForm','Add Package'),
    'type'=>'info',
    'size'=>'small',
    'icon'=>'plus white',
    'url'=>"javascript:viewCreateBookingPackage('$model->id', 'packageFormDiv');",
)); ?>

<div id="packageFormDiv" style="padding-top: 10px"></div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'servicePackageGrid',
    'type'=>'striped condensed',
    'dataProvider'=>$packagesList,
    'template' => "{items}\n{summary}\n{pager}",
    'pagerCssClass'=>'pagination pagination-centered',
    'enableSorting' => false,
    'columns'=>array(
    	array(
            'name' => 'package',
            'value' => '$data->package->name',
        ),
        array(
            'header'=>'Remove',
            'type'=>'raw',
            'value'=>'CHtml::Button("Remove",array("class"=>"btn btn-warning btn-small", "onclick"=>"javascript:deassociateBookingPackage(\'$data->id_booking\', \'$data->id_package\', \'packageFormDiv\', \'linkBookingTab5\');"))',
        ),
    ),
)); ?>