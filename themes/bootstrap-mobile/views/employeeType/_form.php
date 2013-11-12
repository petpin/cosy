<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<!--<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>-->
	
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Create' : 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->