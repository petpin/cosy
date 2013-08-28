<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'booking-days-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="float: left;">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
        
        <div style="clear: both;"></div>
        
        <div class="row" style="float: left;">
            <?php
                echo $form->labelEx($model,'id_supplier'); 
                echo $form->dropDownList($model, 'id_supplier', CHtml::listData(Supplier::model()->findAll(), 'id', 'name'), array('empty' => '', 'options'=>array($model->id_supplier=>array('selected'=>'selected'))));
                echo $form->error($model,'id_supplier');
            ?>
	</div>

	<div class="row" style="float: left; padding-left: 40px;">
		<?php echo $form->labelEx($model,'supplier_rate'); ?>
		<?php echo $form->textField($model,'supplier_rate',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'supplier_rate'); ?>
	</div>
        
        <div style="clear: both;"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->