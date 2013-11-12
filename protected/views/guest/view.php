<?php $this->breadcrumbs=array(
	Yii::t('contentForm','GUEST')=>array('guest/admin'),
	Yii::t('contentForm','VIEW').' - ' . $model->name,
);?>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab"><?php echo Yii::t('contentForm','DETAILS'); ?></a></li>
    <li><a href="#tab2" data-toggle="tab"><?php echo Yii::t('contentForm','BOOKING_LIST'); ?></a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <p>
			<h2><?php $this->widget('editable.EditableField', array(
				'type'      => 'text',
				'model'     => $model,
				'attribute' => 'name',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?></h2>
			<h5>
			<br />
			
			<b><?php echo Yii::t('contentForm','EMAIL'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'text',
				'model'     => $model,
				'attribute' => 'email',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			
			<b><?php echo Yii::t('contentForm','PHONE'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'text',
				'model'     => $model,
				'attribute' => 'phone',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			
			<b><?php echo Yii::t('contentForm','DOCUMENT_ID'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'text',
				'model'     => $model,
				'attribute' => 'document_id',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			
			<b><?php echo Yii::t('contentForm','RESIDENCE'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'text',
				'model'     => $model,
				'attribute' => 'residence',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			
			<b><?php echo Yii::t('contentForm','COUNTRY'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'select',
				'model'     => $model,
				'attribute' => 'id_country',
				'source'    => Editable::source(Country::model()->findAll(), 'id', 'name'),
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			
			<b><?php echo Yii::t('contentForm','LANGUAGE'); ?>:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'select',
				'model'     => $model,
				'attribute' => 'id_language',
				'source'    => Editable::source(Language::model()->findAll(), 'id', 'description'),
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />

			<b>Details:</b> <?php $this->widget('editable.EditableField', array(
				'type'      => 'textarea',
				'model'     => $model,
				'attribute' => 'details',
				'url'       => $this->createUrl('guest/updateEditable'), 
				'placement' => 'right',
			)); ?>
			
			<br />
			</h5>
      </p>
    </div>
    <div class="tab-pane" id="tab2">
      <p>
		<?php // Saca lista de bookings associados ao guest e guardo no array $bookingDetails
		foreach($model->bookingGuest as $booking)
		{
			$modelBooking = Booking::model()->findByPk($booking->id_booking);
			$modelBooking->room = $modelBooking->bookingDays[0]->Room->title;
			$bookingDetails[] = $modelBooking;
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
					array('header'=>Yii::t('contentForm','DATE'), 'name'=>'booking_date'),
					array('header'=>Yii::t('contentForm','ROOM'), 'name'=>'room'),
					array('header'=>Yii::t('contentForm','NIGHT_NUMBER'), 'name'=>'night_num'),
					array('header'=>Yii::t('contentForm','CHECKIN_DATE'), 'name'=>'start_date'),
					array('header'=>Yii::t('contentForm','VALUE'), 'name'=>'value'),
					array('header'=>Yii::t('contentForm','PAID'), 'name'=>'paid'),
					array(
		        		'header'=>Yii::t('contentForm','OPTIONS'),
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
  </div>
</div>