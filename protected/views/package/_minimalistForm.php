<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'serviceForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->dropDownList($model, 'id_service', CHtml::listData(Service::model()->findAll(), 'id', 'name'), array('id' => 'idServiceInput', 'empty' => Yii::t('contentForm','Select a service'))); ?>
	<?php echo $form->hiddenField($model, 'id_package'); ?>
	<?php 
		$this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>Yii::t('contentForm','Associate Service'),
		    'type'=>'success',
		    'htmlOptions'=>array(
		       'onclick'=>'javascript:associateServicePackage("' . $model->id_package . '", $("#idServiceInput").val(), "divCreateServicePackageResult", "linkPackageTab2")'
		        ),
		  ));
  	?>

<?php $this->endWidget(); ?>

<div id="divCreateServicePackageResult"></div>