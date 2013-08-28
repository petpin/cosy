<?php $this->breadcrumbs=array(
	'Report'=>array('supplierBooking'),
	'Supplier Booking',
);

Yii::app()->clientScript->registerCoreScript('jquery'); 
$ourscript = 'function redirect() { parent.location = \'index.php?r=report/supplierBooking&year=\' + $(\'#year\').val(); }';
Yii::app()->clientScript->registerScript('releaseRedirect', $ourscript, CClientScript::POS_HEAD);
?>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/supplierBooking", array('year'=>($year-1))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 70%;">
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)')); ?>
</div>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/supplierBooking", array('year'=>($year+1))),
)); ?>
</div>

<div class="alert alert-success" style="width: 15%; float: left;">
	<?php foreach($supplierNames as $key => $supplier) { ?>
		<h4><?php echo $supplier; ?></h4> <?php echo $totalReservas[$key]; ?> bookings
	<?php } ?>
</div>

<div style="width: 80%; float: right;">
	<div class ="draft_line" id="chart_div" style="clear:both; padding:20px; border:solid 0px;"></div>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  	google.load("visualization", "1", {packages:["corechart"]});
  	google.setOnLoadCallback(drawChart);
  
  	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		<?php foreach($suppliers as $supplier) { echo "data.addColumn('number', '$supplier->name');"; } ?>
		data.addRows([<?php echo $lineGraphData; ?>]);
		var options = { hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}} };
		var chart = new google.visualization.LineChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
			title:'Year Booking Sells By Supplier', vAxis: {maxValue: 10}} );
		chart.draw(data, options);
  	}
</script>


<!-- NOVA VISTA -->

<div style="clear: both;"></div>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/supplierBooking", array('year'=>($year-1))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 70%;">
	<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a month)')); ?>
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)')); ?>
</div>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/supplierBooking", array('year'=>($year+1))),
)); ?>
</div>

<div class="alert alert-success" style="width: 15%; float: left;">
	<?php foreach($supplierNames as $key => $supplier) { ?>
		<h4><?php echo $supplier; ?></h4> <?php echo $totalReservas[$key]; ?> bookings
	<?php } ?>
</div>

<div style="width: 80%; float: right;">
	<div class ="draft_line" id="chart_div_month" style="clear:both; padding:20px; border:solid 0px;"></div>
</div>

<!--<div style="clear: both; width: 100%; height: 300px;">
	<div class="draft_pie" id="pieChart_div" style="clear:both; padding:20px; border:solid 0px;"></div>
</div>-->

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  	google.load("visualization", "1", {packages:["corechart"]});
  	google.setOnLoadCallback(drawChart);
  	//google.setOnLoadCallback(drawPieChart);
  
  	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		<?php foreach($suppliers as $supplier) { echo "data.addColumn('number', '$supplier->name');"; } ?>
		data.addRows([<?php echo $lineGraphData; ?>]);
		var options = { hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}} };
		var chart = new google.visualization.LineChart(document.getElementById('chart_div_month')).draw(data, {lineType: "function",
			title:'Year Booking Sells By Supplier', vAxis: {maxValue: 10}} );
		chart.draw(data, options);
  	}
    
  	/*function drawPieChart() {
		var data = google.visualization.arrayToDataTable([<?php echo $pieGraphData; ?>]);
	
        var options = {
        	'title':'Year Booking Sells By Supplier',
        	'height':300
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('pieChart_div'));
        chart.draw(data, options);
    }*/
</script>