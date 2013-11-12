<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'languageForm',
    'type'=>'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Create' : 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>