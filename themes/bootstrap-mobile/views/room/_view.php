<div class="view">

	<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('Room Name')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Beds Number')); ?>:</b>
	<?php echo CHtml::encode($data->bed_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tipo Quarto')); ?>:</b>
	<?php 
		//echo CHtml::encode($data->id_type);
		
		print_r( RoomType::model()->findByPk( $data->id_type )->description );
		
	?>
	<br />


</div>