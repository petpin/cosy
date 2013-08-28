<div class="view">

	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	</div>

	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	</div>
	
	<div style="clear:both"></div>
	
	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('document_id')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	</div>
	
	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	</div>
	
	<div style="clear:both"></div>
	
	<div style="width:50%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Country')); ?>:</b>
	<?php echo CHtml::encode( Country::model()->findByPk( $data->id_country )->name ); ?>
	</div>

	<div style="width:49%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('Language')); ?>:</b>
	<?php echo CHtml::encode( Language::model()->findByPk( $data->id_language )->description ); ?>
	</div>
	
	<div style="clear:both"></div>

	<div style="width:100%; float:left;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:</b>
	<?php echo CHtml::encode($data->details); ?>
	</div>
	
	<div style="clear:both"></div>
	
</div>