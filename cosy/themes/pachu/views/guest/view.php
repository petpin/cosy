<?php
$this->breadcrumbs=array(
	'Guests'=>array('index'),
	$model->name,
);

$this->menu=array(
//array('label'=>'List Guest', 'url'=>array('index')),
array('label'=>'Create Guest', 'url'=>array('create')),
array('label'=>'Update Guest', 'url'=>array('update', 'id'=>$model->id)),
array('label'=>'Delete Guest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Guest', 'url'=>array('admin')),
);
?>

<h1>View Guest <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
		'phone',
		'document_id',
		array(  // related language displayed
				'label'=>'Country',
				'type'=>'raw',
				'value'=>Country::model()->findByPk( $model->id_country )->name ),
		array(  // related language displayed
				'label'=>'Language',
				'type'=>'raw',
				'value'=>Language::model()->findByPk( $model->id_language )->description ),
		'details',
),
)); 

// Saca lista de bookings associados ao guest e guardo no array $bookingDetails
foreach($model->bookingGuest as $booking)
{
	$bookingDetails[] = Booking::model()->findByPk($booking->id_booking);
}

if(count($bookingDetails) > 0)
{
	?>
	<br />
	<h1>Booking List</h1>
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
