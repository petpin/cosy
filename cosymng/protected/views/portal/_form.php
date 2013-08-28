<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'portal-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'connection_string'); ?>
		<?php echo $form->textField($model,'connection_string',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'connection_string'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_bd'); ?>
		<?php echo $form->textField($model,'user_bd',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_bd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_bd'); ?>
		<?php echo $form->textField($model,'password_bd',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password_bd'); ?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($model,'id_state'); 
		echo $form->dropDownList($model, 'id_state', CHtml::listData(State::model()->findAll(), 'id', 'name') );
		echo $form->error($model,'id_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validity'); ?>
		<?php echo $form->textField($model,'validity',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row">
		<?php 
		echo $form->labelEx($model,'id_package');
		echo $form->dropDownList($model, 'id_package', CHtml::listData(Package::model()->findAll(), 'id', 'name') );
		echo $form->error($model,'id_package'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->