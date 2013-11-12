<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('surname')); ?>:</b>
	<?php echo CHtml::encode($data->surname); ?>
	<br />

	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Employee Type')); ?>:</b>
	<?php 
		//echo CHtml::encode($data->id_type);
		
		print_r( EmployeeType::model()->findByPk( $data->id_employee_type )->description );
		
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />


</div>