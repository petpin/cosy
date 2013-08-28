<?php
/*$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);*/
?>

<div id="content">                
	<div class="wrap clearFix">

		<h2>CONTACT US</h2>

		<?php if(Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>

		<?php else: ?>

		<p>
		If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
		</p>

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'contact-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<fieldset>
				<?php echo $form->labelEx($model,'name'); ?><br />
				<?php echo $form->textField($model,'name', array('class'=>'text')); ?>
				<?php echo $form->error($model,'name'); ?>
			</fieldset>

			<fieldset>
				<?php echo $form->labelEx($model,'email'); ?><br />
				<?php echo $form->textField($model,'email', array('class'=>'text')); ?>
				<?php echo $form->error($model,'email'); ?>
			</fieldset>

			<fieldset>
				<?php echo $form->labelEx($model,'subject'); ?><br />
				<?php echo $form->textField($model,'subject',array('class'=>'text', 'size'=>60, 'maxlength'=>128)); ?>
				<?php echo $form->error($model,'subject'); ?>
			</fieldset>

			<fieldset>
				<?php echo $form->labelEx($model,'body'); ?><br />
				<?php echo $form->textArea($model,'body',array('class'=>'text', 'rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'body'); ?>
			</fieldset>

			<?php if(CCaptcha::checkRequirements()): ?>
			<fieldset>
				<?php echo $form->labelEx($model,'verifyCode'); ?><br />
				<div>
				<?php $this->widget('CCaptcha'); ?>
				<?php echo $form->textField($model,'verifyCode', array('class'=>'text')); ?>
				</div>
				<small>Please enter the letters as they are shown in the image above.
				<br/>Letters are not case-sensitive.</small>
				<?php echo $form->error($model,'verifyCode'); ?>
			</fieldset>
			<?php endif; ?>

			<fieldset>
				<?php echo CHtml::submitButton('Submit', array('class'=>'button')); ?>
			</fieldset>

		<?php $this->endWidget(); ?>

		<?php endif; ?>
	
	</div>
</div>