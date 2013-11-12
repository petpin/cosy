<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'package-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div>
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

	<div>
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
