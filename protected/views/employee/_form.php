<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'employeeForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div style="float: left;">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div style="float: left; padding-left: 10px">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>
	
	<div style="clear: both; float: left;">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div style="float: left; padding-left: 10px">
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordFieldRow($model,'password',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div style="float: left; padding-left: 10px">
		<?php echo $form->dropDownListRow($model, 'id_employee_type', CHtml::listData(EmployeeType::model()->findAll(array("condition"=>"id != 1")), 'id', 'description')); ?>
		<?php echo $form->error($model,'id_employee_type'); ?>
	</div>

	<div style="clear: both">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>
	
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->