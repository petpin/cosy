<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'booking-state-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->