<?php $this->pageTitle=Yii::app()->name; 

	Yii::app()->clientScript->registerCoreScript('jquery'); 

	$ourscript = 'function redirect() {
		parent.location = \'index.php?r=report/supplierRate&year=\' + $(\'#year\').val();
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

	if(isset($_GET["year"]))
		$yearForQuery = $_GET["year"];
	else
		$yearForQuery = $year;
?>

<div style="padding: 20px;">
	<p><?php echo $comboBoxContent; ?> <b>Year</b></p>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  google.setOnLoadCallback(drawPieChart);
  
  function drawChart() {
	
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Month');
	
	<?php
	$suppliers = Supplier::model()->findAll();
	
	foreach($suppliers as $supplier)
	{
		echo "data.addColumn('number', '$supplier->name');";
	}
	?>
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
			
			echo "['$month[1]' ";				
						foreach($suppliers as $supplier)
						{
							$criteria = new CDbCriteria;
							$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
							$criteria->params=array(
								':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
								':day_end'=> $yearForQuery . '-' . $nextMonth . '-01',
								':supplier'=> $supplier->id
								);				
					  echo ', ' . $this->getTotalRatePago($criteria);
						}
				echo "], ";
		}
	?>	 
	]);

	var options = {
	  title: 'Year',
	  hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}}
	};

	var chart = new google.visualization.LineChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
	title:'Yaer Amount of Paid Rates By Supplier',
                  width: 1000, height: 400,
                  vAxis: {maxValue: 10}}
          );;
	chart.draw(data, options);
  }

    function drawPieChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Supplier');
		data.addColumn('number', 'Number of Beds Sold');
		data.addRows(4);
		
		<?php
		
		
		
			$suppliers = Supplier::model()->findAll();
			$cont=0;
			foreach($suppliers as $supplier)
			{
			$criteria = new CDbCriteria;
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-01',
					':supplier'=> $supplier->id);
			
				echo "data.setValue($cont, 0,'$supplier->name');";
				echo "data.setValue($cont, 1," . $this->getTotalRatePago($criteria) . ");";
				$cont++;
			}
		?>

        // Set chart options
        var options = {'title':'Yaer Amount of Paid Rates By Supplier',
                       'width':600,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pieChart_div'));
        chart.draw(data, options);
      }
</script>

<div id="chart_div" style="width: 900px; height: 500px;"></div>
<div id="pieChart_div" style="width: 900px; height: 500px;" align="center"></div>