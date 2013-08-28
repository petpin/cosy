<?php $this->pageTitle=Yii::app()->name; 

	Yii::app()->clientScript->registerCoreScript('jquery'); 

	$ourscript = 'function redirect() {
		parent.location = \'index.php?r=report/year&year=\' + $(\'#year\').val();
	}';
	
	Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

	//This gets today's date
	$date = time();
	
	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);

	$comboBoxContent = '<select id="year" onchange="javascript:redirect()">';
	for ($i_year = -2; $i_year < 3; $i_year++)
	{
		$currentYear = $year + $i_year;
		
		$comboBoxContent .= '<option value="' . $currentYear . '"';
		
		if(!isset($_GET["year"]) && $currentYear == $year)
			{ $comboBoxContent .= " selected='selected' "; $year = $currentYear; }
		else if($currentYear == $_GET["year"])
			{ $comboBoxContent .= " selected='selected' "; $year = $currentYear; }
			
		$comboBoxContent .= '>' . $currentYear . '</option>';
	}
	$comboBoxContent .= '</select>';

?>

<div style="padding: 20px;">

	<p><?php echo $yearComboBoxContent; ?> <b>Year Report</b></p>
	<?php
	if(!Yii::app()->user->isGuest)
	{
		if(isset($_GET["year"]))
			$yearForQuery = $_GET["year"];
		else
			$yearForQuery = $year;
	
		if($yearForQuery==$year)
		{
			$criteria1 = new CDbCriteria;
			$criteria1->condition='day>:day_start AND day<:day_end';
			$criteria1->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery . '-' . $month . '-' .$day);
					
		}
		else
		{
			$criteria1 = new CDbCriteria;
			$criteria1->condition='day>:day_start AND day<:day_end';
			$criteria1->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery+1 . '-01-01');
		}
		
		echo '<table class="table_report_data">';
			echo '<tr>';			
				echo '<td>Sold Beds</td>';
				echo '<td>'.$this->getTotalCamasVendidas($criteria1) .'</td>';
			echo '</tr>';
			echo '<tr>';			
				echo '<td>Value </td>';
				echo '<td>'.$this->getTotalFaturado($criteria1) .' €</td>';
			echo '</tr>';
			echo '<tr>';			
				echo '<td>Value without rates</td>';
				echo '<td>'.$this->getTotalFaturadoSemRate($criteria1) .' €</td>';
			echo '</tr>';
			echo '<tr>';			
				echo '<td>Average Bed Rate</td>';
				echo '<td>'.$this->getAverageBedRate($criteria1) .' € / bed</td>';
			echo '</tr>';
			echo '<tr>';			
				echo '<td>Bed Occupancy Tax</td>';
				echo '<td>'.$this->getBedOccupancyTaxYear($criteria1) .' %</td>';
			echo '</tr>';
		echo "</table>";
	}
	?>
	
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  
  function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Month');
	data.addColumn('number', 'Sold Beds');
	//data.addColumn('number', 'Taxa de Ocupação');
	data.addRows([
		<?php	  
		$months = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);
	  
		foreach($months as $month)
		{
			$currentMonth = (int)$month[0];
			$nextMonth = (int)$month[0] + 1;
		
			$criteria = new CDbCriteria;
			$criteria->condition='day>=:day_start AND day<:day_end';
			$criteria->params=array(':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
									':day_end'=> $yearForQuery . '-' . $nextMonth . '-01');
		
			//print_r($criteria);
			
			echo "['$month[1]', ";
			echo $this->getTotalCamasVendidas($criteria);
			//echo ", " . $this->getTaxaOcupacao($criteria);
			echo "], ";
		}
	?>	 
	]);

	var options = {
	  title: 'Year',
	  hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
                  width: 300, height: 200,
                  vAxis: {maxValue: 10}}
          );;
	chart.draw(data, options);
  }

</script>

<div id="chart_div" style="width: 350px; height: 250px;"></div>
