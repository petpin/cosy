<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bookingDaysForm',
    'type'=>'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div style="float: left;">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
    
    <div style="float: left; padding-left: 20px;">
        <?php
            echo $form->labelEx($model,'id_supplier'); 
            echo $form->dropDownList($model, 'id_supplier', CHtml::listData(Supplier::model()->findAll(), 'id', 'name'), array('empty' => '', 'options'=>array($model->id_supplier=>array('selected'=>'selected'))));
            echo $form->error($model,'id_supplier');
        ?>
	</div>

	<div style="float: left; padding-left: 20px;">
		<?php echo $form->labelEx($model,'supplier_rate'); ?>
		<?php echo $form->textField($model,'supplier_rate',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'supplier_rate'); ?>
	</div>
        
    <div style="clear: both;"></div>

	<div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Create' : 'Save')); ?>
	    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>