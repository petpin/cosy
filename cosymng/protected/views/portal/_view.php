<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Array')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Array), array('view', 'id'=>$data->Array)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('connection_string')); ?>:</b>
	<?php echo CHtml::encode($data->connection_string); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_bd')); ?>:</b>
	<?php echo CHtml::encode($data->user_bd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_bd')); ?>:</b>
	<?php echo CHtml::encode($data->password_bd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_state')); ?>:</b>
	<?php echo CHtml::encode($data->id_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validity')); ?>:</b>
	<?php echo CHtml::encode($data->validity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_package')); ?>:</b>
	<?php echo CHtml::encode($data->id_package); ?>
	<br />


</div>