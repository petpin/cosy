<?php
$this->breadcrumbs=array(
	'Guests'=>array('admin'),
	$model->name,
);
?>

<style>
<!--
.box-client
{
	width: 100%;
	background: #FFF6BF;
	border: 1px solid #FFD324;
	-moz-border-radius: 12px;
	margin: 10px 0;
	font-family: 'Italiana', serif;
}
.box-client .inside	{ padding: 10px; }
.box-client .details	{ padding-left: 15px; }
-->
</style>

<!-- http://www.google.com/webfonts# -->

<div class="box-client">
	<div class="inside">
		<p style="font-size: 20px;"><?php echo $model->name; ?></p>
	
		<div class="details">
			<p><b>Email:</b> <?php echo $model->email; ?></p>
			<p><b>Phone:</b> <?php echo $model->phone; ?></p>
			<p><b>Document Id:</b> <?php echo $model->document_id; ?></p>
			<p><b>Country:</b> <?php echo Country::model()->findByPk( $model->id_country )->name; ?></p>
			<p><b>Language:</b> <?php echo Language::model()->findByPk( $model->id_language )->description; ?></p>
			
			<p><b>Details:</b> <?php echo $model->details; ?></p>
		</div>
	</div>
</div>

<?php 
//CVarDumper::dump($model->bookingGuest);

// Saca lista de bookings associados ao guest e guardo no array $bookingDetails
foreach($model->bookingGuest as $booking)
{
	$bookingDetails[] = Booking::model()->findByPk($booking->id_booking);
}

if(count($bookingDetails) > 0)
{
	//font-family: 'Junge', serif;
	
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
		'dataProvider'=>$dataProvider,
		//'filter'=>$model,
		'columns'=>array(
			array('header'=>'Date', 'name'=>'booking_date'),
			array('header'=>'Night Number', 'name'=>'night_num'),
			array('header'=>'Checkin Date', 'name'=>'start_date'),
			array('header'=>'Value', 'name'=>'value'),
			array('header'=>'Paid', 'name'=>'paid'),
		),
	)); 
}
?>
