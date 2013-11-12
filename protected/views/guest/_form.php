<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bookingForm',
    'type'=>'horizontal',
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div  style="float: left;"><?php echo $form->labelEx($model,'name'); ?>
	<?php echo $form->textField($model,'name'); ?>
	<?php echo $form->error($model,'name'); ?></div>

	<div  style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email', array('size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->error($model,'email'); ?></div>
	
	<div  style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'phone'); ?> 
	<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>15)); ?>
	<?php echo $form->error($model,'phone'); ?></div>
	
	<div style="clear: both;"></div>

	<div style="float: left;"><?php echo $form->labelEx($model,'id_language'); ?>
	<?php echo $form->dropDownList($model,'id_language', CHtml::listData(Language::model()->findAll(), 'id', 'description'), array('empty', 'Select Country')); ?> <?php echo $form->error($model,'id_language'); ?></div>
	
	<div style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'document_id'); ?>
	<?php echo $form->textField($model,'document_id',array('size'=>20,'maxlength'=>20)); ?>
	<?php echo $form->error($model,'document_id'); ?></div>
	
	<div style="float: left; padding-left: 40px;"><?php
		echo $form->labelEx($model,'id_country'); 
		echo $form->dropDownList($model,'id_country', CHtml::listData(Country::model()->findAll(), 'id', 'name'));
		echo $form->error($model,'id_country');
	?></div>
	
	<div style="clear: both;"></div>

	<div style="float: left;">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('size'=>20,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>
	
	<div style="clear: both;"></div>
	
	<div style="float: left; padding: 20px;">
		<?php //echo $form->labelEx($model,'details'); ?>
		<?php echo $form->textAreaRow($model,'details', array('class'=>'span8', 'rows'=>5)); ?>
		<?php echo $form->error($model,'details'); ?>
	</div>
	
	<div style="clear: both;"></div>
	
	<?php echo $form->hiddenField($model, 'idBooking'); ?>
	
	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>Yii::t('contentForm','RESET'))); ?>
	</div>

<?php $this->endWidget(); ?>