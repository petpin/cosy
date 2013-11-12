<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'service-package-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
        <?php echo $form->labelEx($model,'id_service'); ?>        <?php echo $form->textField($model,'id_service',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'id_service'); ?>    </div>

	<div>
        <?php echo $form->labelEx($model,'id_package'); ?>        <?php echo $form->textField($model,'id_package',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'id_package'); ?>    </div>

	<div>
        <?php echo $form->labelEx($model,'creation_date'); ?>        <?php echo $form->textField($model,'creation_date',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'creation_date'); ?>    </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
