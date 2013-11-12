<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'employeeTypeForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->