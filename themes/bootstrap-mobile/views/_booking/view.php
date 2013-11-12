<?php $this->breadcrumbs=array(
    Yii::t('contentForm','BOOKINGS')=>array('admin'),
    $guestName,
);

$model->id_supplier = $model->bookingDays[0]->id_supplier;
$model->id_room = $model->bookingDays[0]->id_room;

if(Yii::app()->session['bookingViewTab'] == '')
	Yii::app()->session['bookingViewTab'] = 'tab2';
//echo Yii::app()->session['bookingViewTab']; // Prints "value"

if(!(isset($ajax) and $ajax == true))
{
?>
	<h4><?php echo Yii::t('contentForm','VIEW_BOOKING_OF'); ?> <?php echo $guestName; ?></h4>
<?php
}
?>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li<?php if(Yii::app()->session['bookingViewTab'] == 'tab1') echo ' class="active"'; ?>><a href="#tab1" data-toggle="tab"><?php echo Yii::t('contentForm','DETAILS'); ?></a></li>
    <li<?php if(Yii::app()->session['bookingViewTab'] == 'tab2') echo ' class="active"'; ?>><a href="#tab2" data-toggle="tab"><?php echo Yii::t('contentForm','DAYS_LIST'); ?></a></li>
    <li<?php if(Yii::app()->session['bookingViewTab'] == 'tab3') echo ' class="active"'; ?>><a href="#tab3" data-toggle="tab"><?php echo Yii::t('contentForm','CLIENTS_LIST'); ?></a></li>
    <li<?php if(Yii::app()->session['bookingViewTab'] == 'tab4') echo ' class="active"'; ?>><a href="#tab4" data-toggle="tab"><?php echo Yii::t('contentForm','SUPPLIER_DETAILS'); ?></a></li>
    <li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo Yii::t('contentForm','ACTIONS'); ?> <b class="caret"></b></a>
	    <ul class="dropdown-menu">
	      <li><a href="<?php echo Yii::app()->createUrl("booking/update" . "&id=" . $model->id); ?>"><?php echo Yii::t('contentForm','UPDATE'); ?></a></li>
	      <li><a href="<?php echo Yii::app()->createUrl("booking/delete" . "&id=" . $model->id); ?>"><?php echo Yii::t('contentForm','DETELE'); ?></a></li>
	      <!--<li class="divider"></li>-->
	      <!--<li><a href="<?php echo Yii::app()->createUrl("guest/create" . "&idBooking=" . $model->id); ?>">Add Guest</a></li>-->
	    </ul>
	</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab1') echo ' active'; ?>" id="tab1">
      <p>
      	<?php $paidValue = '';

		if($model->paid == '0') $paidValue = Yii::t('contentForm','NOT_PAID');
		else			$paidValue = Yii::t('contentForm','PAID');
		
		$this->widget('bootstrap.widgets.TbDetailView', array(
		    'data'=>$model,
		    'attributes'=>array(
		        array(  
		            'label'=>Yii::t('contentForm','ROOM'),
		            'type'=>'raw',
		            'value'=>CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/roomView', 'room'=>$model->id_room, 'month'=>date("m", strtotime($model->start_date)), 'year'=>date("Y", strtotime($model->start_date)))),
		        ),
		        'start_date',
		        'night_num',
		        'value',
		        array( 
		            'label'=>Yii::t('contentForm','PAID'),
		            'type'=>'raw',
		            'value'=>$paidValue,
		        ),
		        array( 
		            'label'=>Yii::t('contentForm','STATE'),
		            'type'=>'raw',
		            'value'=>$model->bookingState->description,
		        ),
		        'booking_date',
		        array( 
		            'label'=>Yii::t('contentForm','SUPPLIER'),
		            'type'=>'raw',
		            'value'=>$model->supplier->name,
		        ),
		        array( 
		            'label'=>Yii::t('contentForm','DETAILS'),
		            'type'=>'raw',
		            'value'=>CHtml::encode(BookingDetails::model()->findByPk($model->id)->comments),
		        ),
		    ),
		));?>
      </p>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab2') echo ' active'; ?>" id="tab2">
      <p>
		<?php $this->widget('bootstrap.widgets.TbGridView', array(
		    'id'=>'roomDaysGrid',
		    'dataProvider'=>$bookingDays,
		    //'summaryText' => 'Showing you {start} - {end} of {count} record(s)',
		    'template' => "{items}\n{summary}\n{pager}",
		    'pagerCssClass'=>'pagination pagination-centered',
		    'columns'=>array(
		        'day',
		        'price',
				'bed_num',
		        //'Room.title',
		        array(
		        	'header'=>Yii::t('contentForm','OPTIONS'),
		            'class'=>'bootstrap.widgets.TbButtonColumn',
		            'buttons'=>array(
		                'view'=>
		                    array(
		                        'url'=>'Yii::app()->createUrl("bookingDays/view", array("id_booking"=>$data->id_booking, "day"=>$data->day))',
		                        'options'=>array(
		                            'ajax'=>array(
		                                'type'=>'POST',
		                                'url'=>"js:$(this).attr('href')",
		                                'success'=>'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }'
		                            ),
		                        ),
		                    ),
		                'update'=>
		                    array(
		                		'url' => 'array("bookingDays/update", "id_booking"=>$data->id_booking, "day"=>$data->day)',
		                	),
		                'deleteButtonUrl' => 'array("bookingDays/delete", "id_booking"=>$data->id_booking, "day"=>$data->day)',
		            ),
		        ),
		    ),
		)); ?>
		<!-- View Popup  -->
		<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal')); ?>
		<!-- Popup Header -->
		<div class="modal-header"><h4><?php echo Yii::t('contentForm','VIEW_DAY_DETAILS'); ?></h4></div>
		<!-- Popup Content -->
		<div class="modal-body"><p><?php echo Yii::t('contentForm','DAY_DETAILS'); ?></p></div>
		<!-- Popup Footer -->
		<div class="modal-footer">
			<!-- close button -->
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>Yii::t('contentForm','CLOSE'),
			    'url'=>'#',
			    'htmlOptions'=>array('data-dismiss'=>'modal'),
			)); ?>
			<!-- close button ends-->
		</div>
		<?php $this->endWidget(); ?>
		<!-- View Popup ends -->
	  </p>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab3') echo ' active'; ?>" id="tab3">
    
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>Yii::t('contentForm','ADD_GUEST'),
		    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'small', // null, 'large', 'small' or 'mini'
		    'icon'=>'plus white',
		    'url'=>Yii::app()->createUrl("guest/create" . "&idBooking=" . $model->id),
		)); ?>
    	
    	<?php $this->widget('bootstrap.widgets.TbGridView', array(
		    'id'=>'roomGuestGrid',
		    'dataProvider'=>$guestsList,
		    'template' => "{items}\n{summary}\n{pager}",
		    'pagerCssClass'=>'pagination pagination-centered',
		    'columns'=>array(
		    	//'$data->guest->name',
		    	array(
		            'name' => 'guest',
		            'value' => '$data->guest->name',
		            //'filter' => CHtml::listData(BookingState::model()->findAll(), 'description', 'description'),
		        ),
		        array(
		            'name' => 'guest',
		            'value' => '$data->guest->email',
		            //'filter' => CHtml::listData(BookingState::model()->findAll(), 'description', 'description'),
		        ),
		        array(
		        	'header'=>'Options',
		            'class'=>'bootstrap.widgets.TbButtonColumn',
		            'buttons'=>array(
		                'view'=>
		                    array(
		                        'url'=>'Yii::app()->createUrl("guest/view", array("id"=>$data->guest->id))',
		                    ),
		                /*'update'=>
		                    array(
		                		'url' => 'array("bookingDays/update", "id_booking"=>$data->id_booking, "day"=>$data->day)',
		                	),
		                'deleteButtonUrl' => 'array("bookingDays/delete", "id_booking"=>$data->id_booking, "day"=>$data->day)',*/
		            ),
		        ),
		    ),
		)); ?>
    	<!--<?php
    	// Grid View with Client List
    	foreach($guestList as $key => $guest)
    	{
    		//echo $key . ' - ';
    		echo $guest . '<br />';
    	}
    	?>
    	<div style="padding-top: 20px;">
	    	<?php 
	    	$modelGuest=new Guest;
	    	$modelGuest->idBooking = $model->id;
	    	
	    	/** @var BootActiveForm $form */
			$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			    'id'=>'guestForm',
			    //'htmlOptions'=>array('class'=>'well'),
			)); ?>
			<h4>Associate Client</h4>
			<div style="float: left; "><?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'name',
				//'value'=>'email',
				'source'=>$this->createUrl('guest/getNames'),
				// additional javascript options for the autocomplete plugin
				'options'=>array(
					'showAnim'=>'fold',
				),
				'htmlOptions'=>array(
					'placeholder'=>'Client Name',
                    'class'=>'span4',
                    'id'=>'clientName',
                )
			));
			//echo $form->textField($modelGuest, 'name', array(/*'class'=>'input-small', */'placeholder'=>'Client Name')); 
			?></div>
			<div style="float: left; padding-left: 10px;"><?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'email',
				'source'=>$this->createUrl('guest/getEmails'),
				'options'=>array(
					'showAnim'=>'fold',
				),
				'htmlOptions'=>array(
					'type'=>'email',
					'prepend'=>'@',
					'placeholder'=>'Client Email',
                    'class'=>'span4',
                    'id'=>'clientEmail',
                ),
			));
			//echo $form->textField($modelGuest, 'email', array('type'=>'email', 'prepend'=>'@', 'placeholder'=>'Client Email')); 
			?></div>
			<div style="float: left; padding-left: 10px;">
			
			<?php
			echo $form->hiddenField($modelGuest, 'idBooking');
			
			echo CHtml::ajaxSubmitButton(
				'Associate',
				array('guest/associateBooking'),
				array(
					'success'=>'function(data){
						$("#associateResult.div").html(data);
					}',
					'beforeSend' => 'function(){
			            $("#associateResult.div").text("Loading..");
			        }',
			        /*'complete' => 'function(){
			            //alert("complete");
			        }',*/
				),
				array(
					'id'=>'ajaxSubmitBtn',
					'name'=>'ajaxSubmitBtn',
					'class'=>'btn btn-success',
				)
			);
			?>
			
			<?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Associate')); ?>
			</div>
			
			<div id="associateResult" class="alert in alert-block fade alert-success" style="clear: both;"></div>			
			
			<div style="clear: both;"></div>
			 
			<?php $this->endWidget(); ?>    	
		</div>-->
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab4') echo ' active'; ?>" id="tab4">
    	<?php
    	// Get Supplier Information Relative to this Booking
    	?>
    </div>
  </div>
</div>