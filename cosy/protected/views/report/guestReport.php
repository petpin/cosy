<?php $this->pageTitle=Yii::app()->name; 
$today = date('Y-m-d', time());
?>

<p>Guest Report</p>

<div style="padding-left: 20px; padding-right: 20px;">
	
	<p>Date <b><?php echo $today;?></b></p>
	<?php
		echo '<table class="table_dailyReport">';
		echo '<tr>';
		echo '<td  class="table_dailyReport_td_title">Guest</td>';
		echo '<td  class="table_dailyReport_td_title">Room</td>';
		echo '<td  class="table_dailyReport_td_title">Beds</td>';
		echo '<td  class="table_dailyReport_td_title">Start Date</td>';
		echo '<td  class="table_dailyReport_td_title">End Date</td>';
		echo '</tr>';
		
		foreach($dataCheckIn as $checkIn)
		{
			echo '<tr>';
			echo '<td class="table_dailyReport_td">'.$checkIn[1] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[2] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[3] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[4] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[5] .'</td>';
			echo '</tr>';
		}
		echo "</table>";	
		echo '<br />';
	?>
	
</div>
