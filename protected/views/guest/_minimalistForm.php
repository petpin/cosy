<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bookingForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
	
	<?php echo $form->textFieldRow($model, 'name', array('class'=>'input-medium')); ?>
	<?php echo $form->textFieldRow($model, 'email', array('size'=>50, 'maxlength'=>50, 'class'=>'input-medium')); ?>
	<?php echo $form->textFieldRow($model, 'phone', array('size'=>15, 'maxlength'=>15, 'class'=>'input-medium')); ?>
	<?php echo $form->hiddenField($model, 'idBooking'); ?>
	
	<?php 
		$this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>Yii::t('contentForm','ADD_GUEST'),
		    'type'=>'success',
		    'htmlOptions'=>array(
		       'onclick'=>'javascript:associateBookingGuest("' . $model->id . '", $("#Guest_name").val(), $("#Guest_email").val(), $("#Guest_phone").val(), "divCreateBookingGuestResult")'
		        ),
		  ));
  	?>

	<div id="divCreateBookingGuestResult"></div>

<?php $this->endWidget(); ?>