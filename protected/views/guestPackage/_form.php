<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'guest-package-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
        <?php echo $form->labelEx($model,'id_booking'); ?>        <?php echo $form->textField($model,'id_booking',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'id_booking'); ?>    </div>

	<div>
        <?php echo $form->labelEx($model,'id_package'); ?>        <?php echo $form->textField($model,'id_package',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'id_package'); ?>    </div>

	<div>
        <?php echo $form->labelEx($model,'create_date'); ?>        <?php echo $form->textField($model,'create_date',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'create_date'); ?>    </div>

	<div>
        <?php echo $form->labelEx($model,'last_update_date'); ?>        <?php echo $form->textField($model,'last_update_date',array('size'=>50,'maxlength'=>50)); ?>       	<?php echo $form->error($model,'last_update_date'); ?>    </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
