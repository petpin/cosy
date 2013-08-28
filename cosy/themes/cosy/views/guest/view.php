<?php
$this->breadcrumbs=array(
	'Guests'=>array('admin'),
	$model->name,
);
?>

<div class="box-client">
	<div class="inside">
		<div class="title">View Guest of <?php echo $model->name; ?></div><div class="icons"><a href="<?php echo Yii::app()->createUrl('guest/update', array('id' => $model->id)); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/big_icons/icon-pen.png" alt="Update" /></a></div>
		<div class="clear"></div>
		<div class="details">
			<div class="item2"><b>Email:</b> <?php echo $model->email; ?></div>
			<div class="item2"><b>Phone:</b> <?php echo $model->phone; ?></div>
			<div class="clear"></div>
			<div class="item2"><b>Country:</b> <?php echo $model->country->name; ?></div>
			<div class="item2"><b>Language:</b> <?php echo $model->language->description; ?></div>
			<div class="clear"></div>
			<div class="item1"><b>Document Id:</b> <?php echo $model->document_id; ?></div>
			<div class="clear"></div>
			<div class="item1"><b>Details:</b> <?php echo $model->details; ?></div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php 
// Saca lista de bookings associados ao guest e guardo no array $bookingDetails
foreach($model->bookingGuest as $booking)
{
	$bookingDetails[] = Booking::model()->findByPk($booking->id_booking);
}

if(count($bookingDetails) > 0)
{
	?>
	<br />
	<h1 style="font-family: 'Philosopher', sans-serif; ">Booking List</h1>
	<?php
	// Coloca o array num CArrayDataProvider para usar na CGridView
	$dataProvider=new CArrayDataProvider($bookingDetails, array(
	    'id'=>'booking-data',
	    'pagination'=>array(
	        'pageSize'=>10,
	    ),
	));
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'booking-grid',
		'cssFile' => Yii::app()->theme->baseUrl .'/css/widgets.css',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			array('header'=>'Booking Date', 'name'=>'booking_date'),
			array('header'=>'Night Number', 'name'=>'night_num'),
			array('header'=>'Checkin Date', 'name'=>'start_date'),
			array('header'=>'Value', 'name'=>'value'),
			/*array(
				'name' => 'paid',
				'value' => array($this,'gridPaidDescription'),
			),*/
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}{update}',
				'viewButtonUrl' => 'array("booking/view", "id"=>$data->id)',
				'updateButtonUrl' => 'array("booking/update", "id"=>$data->id)',
			),
		),
	)); 
}
?>
