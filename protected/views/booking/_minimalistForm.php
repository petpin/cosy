<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'packageForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
	
	<?php echo $form->dropDownList($model, 'id_package', CHtml::listData(Package::model()->findAll(), 'id', 'name'), array('id' => 'idPackageInput', 'empty' => Yii::t('contentForm','Select a package'))); ?>
	<?php echo $form->hiddenField($model, 'id_booking'); ?>
	
	<?php 
		$this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>Yii::t('contentForm','Associate Package'),
		    'type'=>'success',
		    'htmlOptions'=>array(
		       'onclick'=>'javascript:associateBookingPackage("' . $model->id_booking . '", $("#idPackageInput").val(), "divCreateBookingPackageResult", "linkBookingTab5")'
		        ),
		  ));
  	?>

<?php $this->endWidget(); ?>

<div id="divCreateBookingPackageResult"></div>