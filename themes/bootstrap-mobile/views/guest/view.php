<?php $this->breadcrumbs=array(
	'Guest'=>array('guest/admin'),
	'View - ' . $model->name,
);?>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Details</a></li>
    <li><a href="#tab2" data-toggle="tab">Booking List</a></li>
    <li><a href="#tab3" data-toggle="tab">Update</a></li>
    <li class="dropdown">
	    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Actions <b class="caret"></b></a>
	    <ul class="dropdown-menu">
	      <li><a href="<?php echo Yii::app()->createUrl("guest/update" . "&id=" . $model->id); ?></a>">Update</a></li>
	      <li class="divider"></li>
	      <li><a href="#">Temp</a></li>
	    </ul>
	</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <p>
      	<?php $this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$model,
			'attributes'=>array(
			    'name',
			    'email',
			    'phone',
			    'document_id',
			    array(  // related country displayed
			        'label'=>'Country',
			        'type'=>'raw',
			        'value'=>$model->country->name),
			    array(  // related language displayed
			        'label'=>'Language',
			        'type'=>'raw',
			        'value'=>$model->language->description),
			    'residence',
			    'details',
			),
		)); ?>
      </p>
    </div>
    <div class="tab-pane" id="tab2">
      <p>
		<?php // Saca lista de bookings associados ao guest e guardo no array $bookingDetails
		foreach($model->bookingGuest as $booking)
		{
			$bookingDetails[] = Booking::model()->findByPk($booking->id_booking);
		}
		
		if(count($bookingDetails) > 0)
		{
		    // Coloca o array num CArrayDataProvider para usar na CGridView
		    $dataProvider=new CArrayDataProvider($bookingDetails, array(
		        'id'=>'booking-data',
		        'pagination'=>array(
		            'pageSize'=>10,
		        ),
		    ));
		
		    $this->widget('bootstrap.widgets.TbGridView', array(
				'id'=>'booking-grid',
				'dataProvider'=>$dataProvider,
				//'filter'=>$model,
				'columns'=>array(
					array('header'=>'Date', 'name'=>'booking_date'),
					array('header'=>'Night Number', 'name'=>'night_num'),
					array('header'=>'Checkin Date', 'name'=>'start_date'),
					array('header'=>'Value', 'name'=>'value'),
					array('header'=>'Paid', 'name'=>'paid'),
					array(
		        		'header'=>'Options',
		           		'class'=>'bootstrap.widgets.TbButtonColumn',
		           		'template'=>'{view}',
		           		'buttons'=>array(
			                'view'=>
			                    array(
			                        'url'=>'Yii::app()->createUrl("booking/view", array("id"=>$data->id))',
			                    ),
			            ),
		           	),
				),
		    )); 
		}?>
	  </p>
    </div>
    <div class="tab-pane" id="tab3">
		<p>
			<div id="data">
			   <?php //$this->renderPartial('update', array('id'=>$model->id)); ?>
			</div>			 
			<?php /*echo CHtml::ajaxButton ("Update data",
				CController::createUrl('helloWorld/UpdateAjax'), 
				array('update' => '#data'));*/ ?>
		</p>
    </div>
  </div>
</div>