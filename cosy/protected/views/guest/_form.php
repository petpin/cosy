<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guest-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php
			echo $form->labelEx($model,'id_language'); 
			echo $form->dropDownList($model,'id_language', CHtml::listData(Language::model()->findAll(), 'id', 'description'), array('empty', 'Select Country'));
			echo $form->error($model,'id_language');
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'document_id'); ?>
		<?php echo $form->textField($model,'document_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'document_id'); ?>
	</div>
	
	<div class="row">
		<?php
			echo $form->labelEx($model,'id_country'); 
			echo $form->dropDownList($model,'id_country', CHtml::listData(Country::model()->findAll(), 'id', 'name'));
			echo $form->error($model,'id_country');
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'details'); ?>
		<?php echo $form->textField($model,'details',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'details'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>20,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->