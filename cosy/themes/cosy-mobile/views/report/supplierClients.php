<?php $this->pageTitle=Yii::app()->name; 

	Yii::app()->clientScript->registerCoreScript('jquery'); 

	$ourscript = 'function redirect() {
		parent.location = \'index.php?r=report/supplierClients&year=\' + $(\'#year\').val();
	}';
	
	Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

	//This gets today's date
	$date = time();
	
	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);

	$yearActual = $year;
	$monthActual = $month;
	$dayActual = $day;
	
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
	
	if(isset($_GET["year"]))
		$yearForQuery = $_GET["year"];
	else
		$yearForQuery = $year;
?>

<div>
	<p><?php echo $yearComboBoxContent; ?> <b>Year</b></p>
	
	<p><b>Number of sold beds by supplier:</b></p>
</div>

<div class="div_report_data2" style="padding: 10px; border:solid 0px;">
<div class="div_report_data" style="padding: 10px;border:solid 0px;" >
	<?php 
	$suppliers = Supplier::model()->findAll();
	
	if($yearForQuery == $yearActual)
	{
			echo '<table class="table_report_data">';
				foreach($suppliers as $supplier)
				{
					echo '<tr>';
						$criteria = new CDbCriteria;
						$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
						$criteria->params=array(
								':day_start'=> $yearForQuery . '-01-01',
								':day_end'=> $yearForQuery . '-' . $monthActual . '-' .$dayActual,
								':supplier'=> $supplier->id
							  );

						echo '<td>'.$supplier->name .'</td>';
						echo '<td>'.$this->getTotalCamasVendidas($criteria) .'</td>';
					echo '</tr>';
				}	
			echo "</table>";	
			echo '<br />';
	}
	else
	{
			echo '<table class="table_report_data">';
				foreach($suppliers as $supplier)
				{
					echo '<tr>';
						$criteria = new CDbCriteria;
						$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
						$criteria->params=array(
								':day_start'=> $yearForQuery . '-01-01',
								':day_end'=> $yearForQuery . '-12-31',
								':supplier'=> $supplier->id
							  );

						echo '<td>'.$supplier->name .'</td>';
						echo '<td>'.$this->getTotalCamasVendidas($criteria) .'</td>';
					echo '</tr>';
				}	
			echo "</table>";	
			echo '<br />';
	}	
	?>
</div>

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
	  
	    if($yearActual != $yearForQuery)
		{
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
							  echo ', ' . $this->getTotalCamasVendidas($criteria);
								}
						echo "], ";
				}
		}else
		{
			foreach($months as $month)
				{
					$currentMonth = (int)$month[0];
					$nextMonth = (int)$month[0] + 1;
					
					if($currentMonth < $monthActual)
					{
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
									  echo ', ' . $this->getTotalCamasVendidas($criteria);
										}
								echo "], ";
					}
					else //Ano e Mês Actual até ao dia actual
					{								
						if($currentMonth == $monthActual)
						{		
										echo "['$month[1]' ";				
											foreach($suppliers as $supplier)
											{
												$criteria = new CDbCriteria;
												$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
												$criteria->params=array(
													':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
													':day_end'=> $yearForQuery . '-' . $currentMonth . '-' .$dayActual,
													':supplier'=> $supplier->id
													);				
										  echo ', ' . $this->getTotalCamasVendidas($criteria);
												}
									echo "], ";
						}
					}
					if($currentMonth > $monthActual)
							{
								echo "['$month[1]' ";				
										foreach($suppliers as $supplier)
										{
														
											echo ', 0';
										}
								echo "], ";
					}
					
				}
		}
	?>	 
	]);

	var options = {
	  title: 'Year',
	  hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}}
	};

	var chart = new google.visualization.LineChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
				  title:'',
                  width: 300, height: 200,
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
		
				if($yearForQuery < $year || $yearForQuery > $year)
				{
		
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
						echo "data.setValue($cont, 1," . $this->getTotalCamasVendidas($criteria) . ");";
						$cont++;
					}
				}
				else
				{
					$suppliers = Supplier::model()->findAll();
					$cont=0;
					foreach($suppliers as $supplier)
					{
					$criteria = new CDbCriteria;
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
							':day_start'=> $yearForQuery . '-01-01',
							':day_end'=> $yearForQuery . '-'. $monthActual . '-' .$dayActual,
							':supplier'=> $supplier->id);
					
						echo "data.setValue($cont, 0,'$supplier->name');";
						echo "data.setValue($cont, 1," . $this->getTotalCamasVendidas($criteria) . ");";
						$cont++;
					}
				}
		?>

        // Set chart options
        var options = {'title':'',
                       'width':260,
                       'height':250};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('pieChart_div'));
        chart.draw(data, options);
      }
</script>

<div class ="draft_line" id="chart_div" align="center"></div>
<div> </br></div>
<div class ="draft_pie" id="pieChart_div" align="center"></div> 