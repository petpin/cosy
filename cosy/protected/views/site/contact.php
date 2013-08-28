<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>


<h1>TEST</h1>

<?php

	// POST
	// 'http://10.101.71.199:50178/admin',
	// 'data' => array('output'=>'ip360', 'token'=>'xpto'),
	
	$opts = array( 
		'http' => array( 
			'method'=>"GET", 
			'header'=>"Content-Type: text/html; charset=utf-8" 
		) 
	);
	
	$context  = stream_context_create($opts);
	$url = 'http://dre.pt/sug/2s/cp/ddia.asp';
	$result = file_get_contents($url, false, $context, -1, 40000);
	
	$string_de_inicio = '<div id="centro_wide">';
	$string_de_fim = '<script type="text/javascript"';
	
	$pos_incio = stripos($result, $string_de_inicio);
	
	$string_length = strlen($result) - $pos_incio;
	
	$partial_result = substr($result, $pos_incio, $string_length);
	
	$pos_fim = stripos($partial_result, $string_de_fim);
	
	echo $pos_incio . ' - ' . $pos_fim;
	
	//echo substr($result, $pos_incio, ($pos_fim - $pos_incio));
	
	//$result = file_get_contents("http://10.162.201.100:50178/admin?output=ip360");
	echo '<pre>';
	echo $partial_result;
	echo '</pre>';

	//$this->render('viewAdminDetails',array());

?>

<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>