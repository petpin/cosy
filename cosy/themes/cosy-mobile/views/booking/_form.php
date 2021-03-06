<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'booking-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" style="float: left;"><?php echo $form->labelEx($model,'client_name'); ?>
	<?php echo $form->textField($model,'client_name'); ?> <?php echo $form->error($model,'client_name'); ?>
	</div>
	<div style="clear: both;"></div>
	<div class="row" style="float: left;"><?php echo $form->labelEx($model,'client_email'); ?>
	<?php echo $form->textField($model,'client_email',array('client_email'=>'email')); ?> <?php echo $form->error($model,'client_email'); ?></div>

	<div style="clear: both;"></div>
	
	<div class="row" style="float: left;">
		<?php
			if(isset($model->id_supplier))
				$id_supplier = $model->id_supplier;
			else
				$id_supplier = $_GET["supplier"];
		
			echo $form->labelEx($model,'id_supplier'); 
			echo $form->dropDownList($model, 'id_supplier', CHtml::listData(Supplier::model()->findAll(), 'id', 'name'), array('empty' => '',
'options'=>array($id_supplier=>array('selected'=>'selected'))));
			echo $form->error($model,'id_supplier');
		?>
	</div>
	
	<div style="clear: both;"></div>

	<div class="row" style="float: left;"><?php echo $form->labelEx($model,'night_num'); ?>
	<?php echo $form->textField($model,'night_num'); ?> <?php echo $form->error($model,'night_num'); ?>
	</div>

	<div style="clear: both;"></div>
	
	<div class="row" style="float: left;"><?php echo $form->labelEx($model,'bed_num'); ?>
	<?php echo $form->textField($model,'bed_num'); ?> <?php echo $form->error($model,'bed_num'); ?>
	</div>
	
	<div style="clear: both;"></div>
	
	<div class="row" style="float: left;">
		<?php
			if(isset($model->id_room))
				$id_room = $model->id_room;
			else
				$id_room = $_GET["room"];
		
			echo $form->labelEx($model,'id_room'); 
			echo $form->dropDownList($model, 'id_room', CHtml::listData(Room::model()->findAll(), 'id', 'title'), array('empty' => '',
'options'=>array($id_room=>array('selected'=>'selected'))));
			echo $form->error($model,'id_room');
		?>
	</div>

	<div style="clear: both;"></div>

	<div class="row"><?php echo $form->labelEx($model,'start_date'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'id'=>'start_date',
					'model'=>$model,
					'attribute'=>'start_date',
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'yy-mm-dd',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;',
						'value'=>$_GET["start_date"],
					),
				));
	?> <?php echo $form->error($model,'start_date'); ?></div>

	<div style="clear: both;"></div>
	<div class="row" style="float: left;">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div style="clear: both;"></div>

	<div class="row" style="float: left; ">
		<?php
			echo $form->labelEx($model,'Booking State');
			echo $form->dropDownList($model, 'id_state', CHtml::listData(BookingState::model()->findAll(), 'id', 'description') );
			echo $form->error($model,'id_state');
		?>
	</div>

	<div class="row" style="float: left; padding-left: 20px;"><?php echo $form->labelEx($model,'paid'); ?>
	<?php echo $form->checkBox($model,'paid'); ?>
	<?php echo $form->error($model,'paid'); ?></div>

	<div style="clear: both;"></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->