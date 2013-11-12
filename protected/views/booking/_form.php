<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bookingForm',
    'type'=>'horizontal',
)); ?>

	<p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">*</span> <?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="alert alert-block alert-error" style="display:none" id="headerMessagesLabels"><p>Please fix the following input errors:</p>
		<ul>
			<li id="message"></li>
		</ul>
	</div>

	<div  style="clear:both; float: left;"><?php echo $form->labelEx($model,'client_name'); ?>
	<?php echo $form->textField($model,'client_name'); ?><br />
	<?php echo $form->error($model,'client_name'); ?></div>

	<div  style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'client_email'); ?>
	<?php echo $form->textField($model,'client_email',array('client_email'=>'email')); ?><br />
	<?php echo $form->error($model,'client_email'); ?></div>

	<div  style="float: left; padding-left: 40px;">
		<?php
		if(isset($model->id_supplier))
			$id_supplier = $model->id_supplier;
		else
        {
            if(isset($_GET["supplier"]))                            
                $id_supplier = $_GET["supplier"];
            else
                $id_supplier = null;
        }
        
		echo $form->labelEx($model,'id_supplier'); 
		echo $form->dropDownList($model, 'id_supplier', CHtml::listData(Supplier::model()->findAll(), 'id', 'name'), array('empty' => '', 'options'=>array($id_supplier=>array('selected'=>'selected'))));?><br />
		<?php echo $form->error($model,'id_supplier'); ?>
	</div>
	
	<div style="clear: both; padding-top: 5px;"></div>

	<div  style="float: left;">
	<?php echo $form->labelEx($model,'night_num'); ?>
	<?php //echo $form->textField($model,'night_num'); ?>
	<?php echo CHtml::textField('Booking[night_num]', $model->night_num, array('width'=>10, 'maxlength'=>10, 'enable'=>'enable', 'id'=>'night_num',
		'onKeyUp' => CHtml::ajax(array(
			'type'=>'GET', 
			'dataType'=>'json',
			'data'=>array('idRoom'=>"js:$('#Booking_id_room').val()", 'nightNum'=>"js:$(this).val()", 'bedNum'=>"js:$('#bed_num').val()", 'startDate'=>"js:$('#start_date').val()"),
			'url'=>CController::createUrl('booking/verifyRoomSpaceAvailability'),
			'beforeSend'=>'function(xhr, opts){
				console.log(opts.url);
		        if($("#Booking_id_room").val() == "" || $("#night_num").val() == "" || $("#bed_num").val() == "" || $("#start_date").val() == "")
		        {
		            xhr.abort();
		        }
		    }',
			'success'=>'function(data) {
				console.log(data);
				if(data.availability != true)
				{
					$("#message").html("O quarto não tem disponibilidade para essa reserva.");  
					$("#headerMessagesLabels").delay(500).fadeIn("slow");
					$(\'input[type="submit"]\').attr("disabled","disabled");
				}
				else
				{
					$("#headerMessagesLabels").delay(500).fadeOut("slow");
					$(\'input[type="submit"]\').removeAttr("disabled");
				}
			}',
			'error'=>'function(data) {
				console.log(data);
				$("#headerMessagesLabels").html("Erro!");
			}',
		)),
	)); ?><br />
	<?php echo $form->error($model,'night_num'); ?></div>

	<div  style="float: left; padding-left: 40px;">
	<?php echo $form->labelEx($model,'bed_num'); ?>
	<?php //echo $form->textField($model,'bed_num'); ?>
	<?php echo CHtml::textField('Booking[bed_num]', $model->bed_num, array('width'=>10, 'maxlength'=>10, 'enable'=>'enable', 'id'=>'bed_num',
		'onKeyUp' => CHtml::ajax(array(
			'type'=>'GET', 
			'dataType'=>'json',
			'data'=>array('idRoom'=>"js:$('#Booking_id_room').val()", 'nightNum'=>"js:$('#night_num').val()", 'bedNum'=>"js:$(this).val()", 'startDate'=>"js:$('#start_date').val()"),
			'url'=>CController::createUrl('booking/verifyRoomSpaceAvailability'),
			'beforeSend'=>'function(xhr, opts){
				console.log(opts.url);
		        if($("#Booking_id_room").val() == "" || $("#night_num").val() == "" || $("#bed_num").val() == "" || $("#start_date").val() == "")
		        {
		            xhr.abort();
		        }
		    }',
			'success'=>'function(data) {
				console.log(data);
				if(data.availability != true)
				{
					$("#headerMessagesLabels").html("O quarto não tem disponibilidade para essa reserva.");  
					
					if ( $("#headerMessagesLabels").hasClass("label-success") ) {
						$("#headerMessagesLabels").removeClass("label-success").addClass("label-important");
					}
					
					$("#headerMessagesLabels").delay(500).fadeIn("slow");
					$(\'input[type="submit"]\').attr("disabled","disabled");
				}
				else
				{
					$("#headerMessagesLabels").delay(500).fadeOut("slow");
					$(\'input[type="submit"]\').removeAttr("disabled");
				}
			}',
			'error'=>'function(data) {
				console.log(data);
				$("#headerMessagesLabels").html("Erro!");
			}',
		)),
	)); ?><br />
	<?php $this->widget('bootstrap.widgets.TbLabel', array(
	    'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
	    'label'=>'',
	    'htmlOptions'=>array('id'=>'headerMessagesLabels2', 'style'=>'font-size:12px; padding:10px; display:none'),
	)); ?>
	<?php echo $form->error($model,'bed_num'); ?></div>
	
	<div  style="float: left; padding-left: 40px;">
		<?php
		if(isset($model->id_room))
			$id_room = $model->id_room;
		else
			$id_room = $_GET["room"];
	
		echo $form->labelEx($model,'id_room'); 
		echo $form->dropDownList($model, 'id_room', CHtml::listData(Room::model()->findAll(), 'id', 'title'), array(
			'empty' => '',
			'options'=>array($id_room=>array('selected'=>'selected')),
			'onChange' => CHtml::ajax(array(
				'type'=>'GET', 
				'dataType'=>'json',
				'data'=>array('idRoom'=>"js:$(this).val()", 'nightNum'=>"js:$('#night_num').val()", 'bedNum'=>"js:$('#bed_num').val()", 'startDate'=>"js:$('#start_date').val()"),
				'url'=>CController::createUrl('booking/verifyRoomSpaceAvailability'),
				'beforeSend'=>'function(xhr, opts){
					console.log(opts.url);
			        if($("#Booking_id_room").val() == "" || $("#night_num").val() == "" || $("#bed_num").val() == "" || $("#start_date").val() == "")
			        {
			            xhr.abort();
			        }
			    }',
				'success'=>'function(data) {
					console.log(data);
					if(data.availability != true)
					{
						$("#headerMessagesLabels").html("O quarto não tem disponibilidade para essa reserva.");  
						
						if ( $("#headerMessagesLabels").hasClass("label-success") ) {
							$("#headerMessagesLabels").removeClass("label-success").addClass("label-important");
						}
						
						$("#headerMessagesLabels").delay(500).fadeIn("slow");
						$(\'input[type="submit"]\').attr("disabled","disabled");
					}
					else
					{
						$("#headerMessagesLabels").delay(500).fadeOut("slow");
						$(\'input[type="submit"]\').removeAttr("disabled");
					}
				}',
				'error'=>'function(data) {
					console.log(data);
					$("#headerMessagesLabels").html("Erro!");
				}',
			)),
		));?><br />
		<?php echo $form->error($model,'id_room'); ?>
	</div>

	<div style="clear: both; padding-top: 5px;"></div>

	<div style="float: left;">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'id'=>'start_date',
			'model'=>$model,
			'attribute'=>'start_date',
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				/*
				'dateFormat' => 'dd/mm/y',
				'showAnim' => 'slideDown',
				'changeMonth' => true,
				'changeYear' => true,
				'showOn' => 'button',
				'constrainInput' => 'true',
				*/
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;',
				'value'=>$_GET["start_date"],
			),
			/*'onKeyUp' => CHtml::ajax(array(
				'type'=>'GET', 
				'dataType'=>'json',
				'data'=>array('idRoom'=>"js:$('#Booking_id_room').val()", 'nightNum'=>"js:$('#night_num').val()", 'bedNum'=>"js:$('#bed_num').val()", 'startDate'=>"js:$(this).val()"),
				'url'=>CController::createUrl('booking/verifyRoomSpaceAvailability'),
				'beforeSend'=>'function(xhr, opts){
					console.log(opts.url);
			        if($("#Booking_id_room").val() == "" || $("#night_num").val() == "" || $("#bed_num").val() == "" || $("#start_date").val() == "")
			        {
			            xhr.abort();
			        }
			    }',
				'success'=>'function(data) {
					console.log(data);
					if(data.availability != true)
					{
						$("#headerMessagesLabels").html("O quarto não tem disponibilidade para essa reserva.");  
						
						if ( $("#headerMessagesLabels").hasClass("label-success") ) {
							$("#headerMessagesLabels").removeClass("label-success").addClass("label-important");
						}
						
						$("#headerMessagesLabels").delay(500).fadeIn("slow");
						$(\'input[type="submit"]\').attr("disabled","disabled");
					}
					else
					{
						$("#headerMessagesLabels").delay(500).fadeOut("slow");
						$(\'input[type="submit"]\').removeAttr("disabled");
					}
				}',
				'error'=>'function(data) {
					console.log(data);
					$("#headerMessagesLabels").html("Erro!");
				}',
			)),*/
		)); ?><br />
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div  style="float: left; padding-left: 40px;">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?><br />
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div style="clear: both; padding-top: 5px;"></div>

	<div style="float: left; ">
		<?php echo $form->labelEx($model,'Booking State'); ?>
		<?php echo $form->dropDownList($model, 'id_state', CHtml::listData(BookingState::model()->findAll(), 'id', 'description') ); ?><br />
		<?php echo $form->error($model,'id_state'); ?>
	</div>

	<div  style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'paid'); ?>
	<?php echo $form->checkBox($model,'paid'); ?><br />
	<?php echo $form->error($model,'paid'); ?></div>

	<div style="clear: both; padding-top: 5px;"></div>
	
	<div  style="float: left; padding-left: 40px;"><?php echo $form->labelEx($model,'comments'); ?>
	<?php echo $form->textarea($model,'comments', array('class'=>'span6', 'rows'=>5)); ?><br />
	<?php echo $form->error($model,'comments'); ?></div>

	<div style="clear: both;"></div>
	
	<?php
		$display = 'block';
		
		if($_GET["ajaxRequest"] == true)
		{
			$display = 'none';
		}
	?>
	
	<div class="form-actions" style="display: <?php echo $display; ?>">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE'))); ?>
	</div>

<?php $this->endWidget(); ?>