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

	
	$thisMonth = $month;
	
	if(!isset($_GET["year"]))
		$yearToSearch = $year;
	else
		$yearToSearch = $_GET["year"];
		
	if(!isset($_GET["month"]))
		$monthToSearch = $month;
	else
		$monthToSearch = $_GET["month"];
	

	/*
	* 	Francisco Fernandes 2012	
	*
	*	Codigo responsavel pela população da combo de anos, o codigo vai preenchendo a combo consuante o ano do presente
	*
	*/
	
		$yearComboBoxContent = '<select id="year" onchange="javascript:redirect()">';
		for ($yearFor=$yearToSearch-2; $yearFor <= $year; $yearFor++)
		{
			$yearComboBoxContent .= '<option value="' . $yearFor . '"';
			
			if($yearFor == $yearToSearch)
				$yearComboBoxContent .= " selected='selected' "; 
				
			$yearComboBoxContent .= '>' . $yearFor . '</option>';
		}
		$yearComboBoxContent .= '</select>';
		
		
	
?>

<div style="padding: 20px;">

	<p><?php echo $yearComboBoxContent; ?> <b>Year</b></p>
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
			$criteria1->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery . '-' . $thisMonth . '-' .$day);
					
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
	  
	  if($yearForQuery < $year || $yearForQuery > $year)
	  {
			foreach($months as $month)
			{
				$currentMonth = (int)$month[0];
				$nextMonth = (int)$month[0] + 1;
			
				$criteria = new CDbCriteria;
				$criteria->condition='day>=:day_start AND day<:day_end';
				$criteria->params=array(':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
										':day_end'=> $yearForQuery . '-' . $nextMonth . '-01');
			
				//print_r($criteria);
				
				echo "['" . $month[1] . "', ";
				echo $this->getTotalCamasVendidas($criteria);
				//echo ", " . $this->getTaxaOcupacao($criteria);
				echo "], ";
			}
		}
		else
		{	
			
			foreach($months as $month)
			{
					$currentMonth = (int)$month[0];
					$nextMonth = (int)$month[0] + 1;
				
				if($currentMonth<$thisMonth)
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
				
				else
				{
					if($currentMonth==$thisMonth)
					{	$criteria = new CDbCriteria;
						$criteria->condition='day>=:day_start AND day<:day_end';
						$criteria->params=array(':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
												':day_end'=> $yearForQuery . '-' . $currentMonth . '-' . $day);
						//print_r($criteria);
						
						echo "['$month[1]', ";
						echo $this->getTotalCamasVendidas($criteria);
						//echo ", " . $this->getTaxaOcupacao($criteria);
						echo "], ";
					}
					else
					{
						echo "['$month[1]', ";
						echo '0';
						//echo ", " . $this->getTaxaOcupacao($criteria);
						echo "], ";
					}
				}	
			}
		}
		
	
	?>	 
	]);

	var options = {
	  title: 'Year',
	  hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
                  width: 1000, height: 400,
                  vAxis: {maxValue: 10}}
          );;
	chart.draw(data, options);
  }

</script>

<div id="chart_div" style="width: 900px; height: 500px;"></div>
