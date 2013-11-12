<?php $this->breadcrumbs=array(
    Yii::t('contentForm','BOOKINGS')=>array('admin'),
    $guestName,
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/booking.js'
);
?>

<?php /* Click in last selected tab */ ?>
<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function(){ 
			$('#<?php if(!isset(Yii::app()->session['bookingViewTab'])) echo "linkBookingTab1"; else echo Yii::app()->session['bookingViewTab']; ?>').click();
		}, 100 );
	});
</script>

<?php
if(!(isset($ajax) and $ajax == true))
{
	?><h1><?php echo Yii::t('contentForm','VIEW_BOOKING_OF'); ?> <?php echo $guestName; ?></h1><?php
}
?>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li><a href="#tab1" data-toggle="tab" id="linkBookingTab1"><?php echo Yii::t('contentForm','DETAILS'); ?></a></li>
    <li><a href="#tab2" data-toggle="tab" id="linkBookingTab2"><?php echo Yii::t('contentForm','DAYS_LIST'); ?></a></li>
    <li><a href="#tab3" data-toggle="tab" id="linkBookingTab3"><?php echo Yii::t('contentForm','CLIENTS_LIST'); ?></a></li>
    <li><a href="#tab4" data-toggle="tab" id="linkBookingTab4"><?php echo Yii::t('contentForm','SUPPLIER_DETAILS'); ?></a></li>
    <li><a href="#tab5" data-toggle="tab" id="linkBookingTab5"><?php echo Yii::t('contentForm','Packages'); ?></a></li>
    <li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo Yii::t('contentForm','ACTIONS'); ?> <b class="caret"></b></a>
	    <ul class="dropdown-menu">
	      <li><a href="<?php echo Yii::app()->createUrl("booking/update" . "&id=" . $model->id); ?>"><?php echo Yii::t('contentForm','UPDATE_1'); ?></a></li>
	      <li><a href="<?php echo Yii::app()->createUrl("booking/delete" . "&id=" . $model->id); ?>"><?php echo Yii::t('contentForm','DELETE'); ?></a></li>
	      <!--<li class="divider"></li>-->
	      <!--<li><a href="<?php echo Yii::app()->createUrl("guest/create" . "&idBooking=" . $model->id); ?>"><?php echo Yii::t('contentForm','ADD_GEST'); ?></a></li>-->
	    </ul>
	</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab1') echo ' active'; ?>" id="tab1">
    	<?php     	
    	if(!$ajax)
    	{
    		?>
    		<div style="float: left; width: 50%;">
    		<?php $this->widget('bootstrap.widgets.TbDetailView', array(
			    'data'=>$model,
			    'type'=>'bordered',
			    'attributes'=>array(
			    	//'id',
			    	array(
			    		'class' => 'editable.EditableColumn',
				        'name' => 'start_date',
				        'editable' => array(
				            'type'      => 	'text',
				            'inputclass'=> 	'input-large',
				            //'emptytext' => 	'special emptytext',
				            'url'		=>	$this->createUrl('booking/updateEditable'),
				            'placement' => 'right',
				        ),
				    ),
			        array(
			            'label'=>Yii::t('contentForm','ROOM'),
			            'type'=>'raw',
			            'value'=>CHtml::link(CHtml::encode(Room::model()->findByPk($model->id_room)->title),array('site/roomView', 'room'=>$model->id_room, 'month'=>date("m", strtotime($model->start_date)), 'year'=>date("Y", strtotime($model->start_date)))),
			        ),
			        array(
			           'class' => 'editable.EditableColumn',
			           'name' => 'night_num',
			        ),
			        array(
			           'label'=>Yii::t('contentForm','TOTAL_PRICE'),
			           'type'=>'raw',
			           'value' => $totalValueToPay . " " . Yii::t('contentForm','EUR'),
			        ),
			        //'value',
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
			    ),
			));?>
			
			</div>
			
			<div style="float: right; width: 45%;">
				<b><?php echo Yii::t('contentForm','DETAILS'); ?>:</b> 
				<?php
				if(!($modelBookingDetails == null))
				{
					$this->widget('editable.EditableField', array(
				        'type'        => 'textarea',
				        'model'       => $modelBookingDetails,
				        'attribute'   => 'comments',
				        'url'         => $this->createUrl('bookingDetails/updateEditable'), 
				        'placement'   => 'left',
				        'showbuttons' => 'bottom',
				    ));
				} 
				?>
			</div>
			
			<script type="text/javascript">
	    	$(document).ready(function() {
			    $("#linkBookingTab1").click(function() {
					updateBookingViewTab('<?php echo $model->id; ?>');
				});
			});
			</script>
			<?php
		}
		else
		{
			?>
			<div id="viewDetailsContent"></div>
			<script type="text/javascript">
	    	$(document).ready(function() {
			    $("#linkBookingTab1").click(function() {
					viewDetails('<?php echo $model->id; ?>', 'viewDetailsContent');
				});
			});
			</script>
			<?php	
		} ?>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab2') echo ' active'; ?>" id="tab2">
    	<script type="text/javascript">
    	$(document).ready(function() {
		    $("#linkBookingTab2").click(function() {
				viewDays('<?php echo $model->id; ?>', 'viewDaysContent');
			});
		});
		</script>
    	<div id="viewDaysContent"></div>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab3') echo ' active'; ?>" id="tab3">
    	<script type="text/javascript">
    	$(document).ready(function() {
		    $("#linkBookingTab3").click(function() {
				viewGuest('<?php echo $model->id; ?>', 'viewGuestContent');
			});
		});
		</script>
    	<div id="viewGuestContent"></div>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab4') echo ' active'; ?>" id="tab4">
    	<?php
    	// Get Supplier Information Relative to this Booking
    	?>
    	<script type="text/javascript">
    	$(document).ready(function() {
		    $("#linkBookingTab4").click(function() {
				viewSupplier('<?php echo $model->id; ?>', '<?php echo $model->id_supplier; ?>', '<?php echo $totalValueToPay; ?>', 'viewSupplierContent');
			});
		});
		</script>
    	<div id="viewSupplierContent"></div>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['bookingViewTab'] == 'tab5') echo ' active'; ?>" id="tab5">
    	<?php
    	// Get Supplier Information Relative to this Booking
    	?>
    	<script type="text/javascript">
    	$(document).ready(function() {
		    $("#linkBookingTab5").click(function() {
				viewPackages('<?php echo $model->id; ?>', 'viewPackagesContent');
			});
		});
		</script>
    	<div id="viewPackagesContent"></div>
    </div>
  </div>
</div>