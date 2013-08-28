<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>
	
	<div class="row">
		<?php
			/*echo $form->labelEx($model,'id_employee_type');*/
			echo $form->labelEx($model,'Employee Type'); 
			
			?>
			
			<select name="Employee[id_employee_type]" id="Employee_id_employee_type">
				<option value="2">Manager</option>
				<option value="4">Employee</option>
			</select>
			<?php
			/*
			$employeeTypeData = CHtml::listData(EmployeeType::model()->findAll(), 'id', 'description');
			echo $form->dropDownList($model,'id_employee_type', $employeeTypeData);
			*/
			echo $form->error($model,'id_employee_type');
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->