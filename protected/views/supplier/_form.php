<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'supplier-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'rate_value'); ?>
		<?php echo $form->textField($model,'rate_value'); ?>
		<?php echo $form->error($model,'rate_value'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->