<?php
$this->breadcrumbs=array(
	'Daily'=>array('dailyReport'),
	'Year'=>array('year'),
	'Month'=>array('month'),
	'Manage',
);
?>

<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');
?>

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


<div class="flash-notice span-22 last">

	<p><?php echo $comboBoxContent; ?> <b>Year</b></p>
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

<div class="clear"></div>

<div class="span-13 last">
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'Sold Bed',
));
?>
<div class="chart3">
    <div>
        <div class="text">
            <table class="myChart">
                <thead>
                    <tr>
                        <th></th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                    </tr>
                </thead>

                <tbody>
					<tr>
						<th>Sold Beds</th>
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
								
								
								echo '<td>' . $this->getTotalCamasVendidas($criteria) . '</td>';
							}
						?>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
    </div>
</div>
<?php $this->endWidget();?>
</div>