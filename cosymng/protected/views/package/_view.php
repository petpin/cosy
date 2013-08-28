<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Array')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Array), array('view', 'id'=>$data->Array)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_per_month')); ?>:</b>
	<?php echo CHtml::encode($data->price_per_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />


</div>