<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->