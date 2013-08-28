<?php $this->breadcrumbs=array(
	'Report'=>array('year'),
	'Year',
);

Yii::app()->clientScript->registerCoreScript('jquery'); 
$ourscript = 'function redirect() { parent.location = \'index.php?r=report/year&year=\' + $(\'#year\').val(); }';
Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);
?>

<div style="float: left; text-align: right; width: 30%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/year", array('year'=>($year-1))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 40%;">
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)')); ?>
</div>

<div style="float: left; text-align: left; width: 30%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/year", array('year'=>($year+1))),
)); ?>
</div>

<div style="clear: both"></div>

<div class="alert alert-success" style="width: 15%; float: left;">
	<h4>Sold Beds</h4> <?php echo $totalCamasVendidas; ?> beds
	<h4>Value</h4> <?php echo $totalFaturado; ?> €
	<h4>Value without rates</h4> <?php echo $totalFaturadoSemRate; ?> €
	<h4>Average Bed Rate</h4> <?php echo $averageBedRate; ?> €
	<h4>Bed Occupancy Tax</h4> <?php echo $bedOccupancyTaxYear; ?> %
</div>

<div style="width: 80%; float: right;">

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChart);
	  
	  function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		data.addColumn('number', 'Sold Beds');
		//data.addColumn('number', 'Taxa de Ocupação');
		data.addRows([<?php echo $graphData; ?>]);
		var options = { title: 'Year', hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}} };
		var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function", vAxis: {maxValue: 10}} );
		chart.draw(data, options);
	  }
	</script>

	<div id="chart_div" style="width: 100%;"></div>

</div>