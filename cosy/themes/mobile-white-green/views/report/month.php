<?php $this->pageTitle=Yii::app()->name; 

	Yii::app()->clientScript->registerCoreScript('jquery'); 

	$ourscript = 'function redirect() {
		parent.location = \'index.php?r=report/month&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
	}';
	
	Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

	//This gets today's date
	$date = time() ;
	
	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);
	
	if(!isset($_GET["year"]))
		$yearToSearch = $year;
	else
		$yearToSearch = $_GET["year"];
		
	if(!isset($_GET["month"]))
		$monthToSearch = $month;
	else
		$monthToSearch = $_GET["month"];

	$months = array(array("01","January"), 
					array("02","February"), 
					array("03","March"), 
					array("04","April"), 
					array("05","May"), 
					array("06","June"), 
					array("07","July"), 
					array("08","August"), 
					array("09","September"), 
					array("10","October"), 
					array("11","Novemeber"), 
					array("12","December"),
				);
	
	$monthComboBoxContent = '<select id="month" onchange="javascript:redirect()">';
	foreach ($months as $monthname)
	{
		$monthComboBoxContent .=  '<option value="' . $monthname[0] . '"';
		
		if($monthname[0] == $monthToSearch)
			$monthComboBoxContent .=  " selected='selected' ";
		
		$monthComboBoxContent .=  '>' . $monthname[1] . '</option>';
	}
	$monthComboBoxContent .=  '</select>';

	$yearComboBoxContent = '<select id="year" onchange="javascript:redirect()">';
	for ($i_year = -2; $i_year < 3; $i_year++)
	{
		$currentYear = $yearToSearch + $i_year;
		
		$yearComboBoxContent .= '<option value="' . $currentYear . '"';

		if($currentYear == $yearToSearch)
			{ $yearComboBoxContent .= " selected='selected' "; $year = $currentYear; }
			
		$yearComboBoxContent .= '>' . $currentYear . '</option>';
	}
	$yearComboBoxContent .= '</select>';

?>

<div style="padding: 20px;">
	
	<p><?php echo $monthComboBoxContent; ?> <b>Month</b> <?php echo $yearComboBoxContent; ?> <b>Year</b></p>
	<?php
	if(!Yii::app()->user->isGuest)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='day>=:day_start AND day<:day_end';
		$criteria->params=array(':day_start'=> $yearToSearch . '-' . $monthToSearch . '-01',
								':day_end'=> $yearToSearch . '-' . ($monthToSearch+1) . '-01');

		$this->getStatsMes($criteria, $monthToSearch, $yearToSearch);
	}
	?>
	
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Days');
	data.addColumn('number', 'Sold Beds');
	data.addColumn('number', 'Taxa de Ocupação');
	//data.addColumn('number', 'Total Faturado');
	data.addRows([
		<?php
	  	//We then determine how many days are in the current month
		$days_in_month = cal_days_in_month(0, $monthToSearch, $yearToSearch);
		
		$day_num = 1;
		
		//count up the days, untill we've done all of them in the month
		while ( $day_num <= $days_in_month )
		{		
			$criteria = new CDbCriteria;
			$criteria->condition='day = :day';
			$criteria->params=array(':day'=> $yearToSearch . '-' . $monthToSearch . '-' .$day_num);
		
			//print_r($criteria);
			echo "['$day_num', ";
			echo $this->getTotalCamasVendidas($criteria);
			echo ", " . $this->getTaxaOcupacao($criteria);
			//echo ", " . echo $this->getTotalFaturado($criteria);
			echo "], ";
			$day_num++;
		}
	?>	 
	]);

	var options = {
	  title: 'Month',
	  hAxis: {title: 'Month View', titleTextStyle: {color: 'red'}}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
                  width: 1000, height: 400,
                  vAxis: {maxValue: 10}}
          );;
	chart.draw(data, options);
  }
</script>
<div id="chart_div" style="width: 900px; height: 500px;"></div>