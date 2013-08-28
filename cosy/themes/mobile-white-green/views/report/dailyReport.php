<?php $this->pageTitle=Yii::app()->name; 
$today = date('Y-m-d', time());
?>

<p>Daily Report</p>

<div style="padding-left: 20px; padding-right: 20px;">
	
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
							echo '<td>'.$checkIn[3].'</td>';
							echo '<td>'.$checkIn[4] .'</td>';
							
							echo '<td>' . 
							CHtml::dropDownList('id_state', '', CHtml::listData(BookingState::model()->findAll(), 'id', 'description'),
								array(
								'ajax' => array(
									'type'=>'POST', //request type
									'url'=>CController::createUrl('booking/ajaxStateUpdate'),
									'update'=>'#state_updated', //selector to update
									'data'=> array('id'=>$checkIn[0], 'id_state' =>'$("id_state").val()'),
									//leave out the data key to pass all form values through
								))
							) 
							. '</td>'; 
							
							
				echo '<div id="state_updated"></div></tr>';		
				}
			echo "</table>";	
			echo '<br />';	
	
	?>
	
</div>

<div style="padding-left: 20px; padding-right: 20px;">
	
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
			echo '<td>METER BOTAO</td>';
			echo '</tr>';		
		}
		echo "</table>";	
		echo '<br />';	
	?>
	
</div>