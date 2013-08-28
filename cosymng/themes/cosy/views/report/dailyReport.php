<?php $this->pageTitle=Yii::app()->name; 
$today = date('Y-m-d', time());
?>

<p>Daily Report</p>

<div class="flash-notice span-22 last">
	
	<p>Check In <b><?php echo $today;?></b></p>
	<?php
			
		echo '<table class="table_dailyReport">';
		echo '<tr>';
		echo '<td>Guest</td>';
		echo '<td>Room</td>';
		echo '<td>Beds Number</td>';
		echo '<td>Value</td>';
		echo '</tr>';
		foreach($dataCheckIn as $checkIn)
		{
			echo '<tr>';
			echo '<td>'.$checkIn[1] .'</td>';
			echo '<td>'.$checkIn[2] .'</td>';
			echo '<td>'.$checkIn[3] .'</td>';
			echo '<td>'.$checkIn[4] .'</td>';
			echo '<td>' . 
			CHtml::dropDownList('id_state_' . $checkIn[0], $checkIn[5], CHtml::listData(BookingState::model()->findAll(), 'id', 'description'),
				array(
				'ajax' => array(
					'type'=>'POST', 
				 	'dataType'=>'json',
				 	'data'=>array('id_booking'=>$checkIn[0], 'id_state'=>'js: $(this).val()'),
				  	'url'=>CController::createUrl('booking/ajaxStateUpdate'),
				  	'success'=>'function(data) {
				     	$("#state_updated_' . $checkIn[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","green");
				     	$("#state_updated_' . $checkIn[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkIn[0] . '").delay(300).fadeOut("slow");
				  	}',
					'error'=>'function(data) {
				     	$("#state_updated_' . $checkIn[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","red");
				     	$("#state_updated_' . $checkIn[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkIn[0] . '").delay(300).fadeOut("slow");
				  	}',
				))
			) 
			. '<span id="state_updated_' . $checkIn[0] . '"></span></td>';
			echo '</tr>';
		}
		echo "</table>";	
		echo '<br />';	
	
	?>
	
</div>

<div class="flash-notice span-22 last">
	
	<p>Check Out <b><?php echo $today;?></b></p>
	<?php
		echo '<table class="table_dailyReport">';
		echo '<tr>';
		echo '<td>Guest</td>';
		echo '<td>Room</td>';
		echo '<td>Beds Number</td>';
		echo '<td>Value</td>';
		echo '</tr>';
		
		foreach($dataCheckOut as $checkOut)
		{
			echo '<tr>';
			echo '<td>'.$checkOut[1] .'</td>';
			echo '<td>'.$checkOut[2] .'</td>';
			echo '<td>'.$checkOut[3].'</td>';
			echo '<td>'.$checkOut[4] .'</td>';
			echo '<td>' . 
			CHtml::dropDownList('id_state_' . $checkOut[0], $checkOut[5], CHtml::listData(BookingState::model()->findAll(), 'id', 'description'),
				array(
				'ajax' => array(
					'type'=>'POST', 
				 	'dataType'=>'json',
				 	'data'=>array('id_booking'=>$checkOut[0], 'id_state'=>'js: $(this).val()'),
				  	'url'=>CController::createUrl('booking/ajaxStateUpdate'),
				  	'success'=>'function(data) {
				     	$("#state_updated_' . $checkOut[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","green");
				     	$("#state_updated_' . $checkOut[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkOut[0] . '").delay(300).fadeOut("slow");
				  	}',
					'error'=>'function(data) {
				     	$("#state_updated_' . $checkOut[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","red");
				     	$("#state_updated_' . $checkOut[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkOut[0] . '").delay(300).fadeOut("slow");
				  	}',
				))
			) 
			. '<span id="state_updated_' . $checkOut[0] . '"></span></td>';
			echo '</tr>';		
		}
		
		echo "</table>";	
		echo '<br />';	
	?>
	
</div>