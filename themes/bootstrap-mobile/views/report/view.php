<?php 
if(Yii::app()->session['reportViewTab'] == '')
	Yii::app()->session['reportViewTab'] = 'tab1';
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li<?php if(Yii::app()->session['reportViewTab'] == 'tab1') echo ' class="active"'; ?>><a href="#tab1" data-toggle="tab">Year</a></li>
    <li<?php if(Yii::app()->session['reportViewTab'] == 'tab2') echo ' class="active"'; ?>><a href="#tab2" data-toggle="tab">Month</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane<?php if(Yii::app()->session['reportViewTab'] == 'tab1') echo ' active'; ?>" id="tab1">
      <p>
<div style="float: left; text-align: right; width: 10%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/year", array('year'=>($year-1))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 80%;">
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)', 'style'=>'width: 90%;')); ?>
</div>

<div style="float: left; text-align: left; width: 10%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/year", array('year'=>($year+1))),
)); ?>
</div>

<div style="clear: both"></div>

<div>

	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChart);
	  
	  function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Month');
		data.addColumn('number', 'Sold Beds');
		//data.addColumn('number', 'Taxa de Ocupação');
		data.addRows([<?php echo $graphData; ?>]);
		var options = { title: 'Year', legend: {position: 'bottom'}, hAxis: {title: 'Year View', titleTextStyle: {color: 'red'}} };
		var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function", vAxis: {maxValue: 10}} );
		chart.draw(data, options);
	  }
	</script>

	<div id="chart_div" style="width: 100%;"></div>

</div>

<div class="alert alert-success" style="padding-top: 10px;">
	<h4>Sold Beds</h4> <?php echo $totalCamasVendidas; ?> beds
	<h4>Value</h4> <?php echo $totalFaturado; ?> €
	<h4>Value without rates</h4> <?php echo $totalFaturadoSemRate; ?> €
	<h4>Average Bed Rate</h4> <?php echo $averageBedRate; ?> €
	<h4>Bed Occupancy Tax</h4> <?php echo $bedOccupancyTaxYear; ?> %
</div>
      </p>
    </div>
    <div class="tab-pane<?php if(Yii::app()->session['reportViewTab'] == 'tab2') echo ' active'; ?>" id="tab2">
      <p>
<div style="float: left; text-align: right; width: 20%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/month", array('month'=>($month-1), 'year'=>$year)),
)); ?>
</div>

<div style="float: left; text-align: center; width: 60%;">
	<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'month', 'onchange' => 'javascript:redirect()', 'style'=>'width: 90%;')); ?> 
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)', 'style'=>'width: 90%;')); ?>
</div>

<div style="float: left; text-align: left; width: 20%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/month", array('month'=>($month+1), 'year'=>$year)),
)); ?>
</div>

<div style="clear: both"></div>

<div class="alert alert-success" style="width: 15%; float: left;">
	<h4>Sold Beds</h4> <?php echo $totalCamasVendidas; ?> beds
	<h4>Value</h4> <?php echo $totalFaturado; ?> €
	<h4>Value without rates</h4> <?php echo $totalFaturadoSemRate; ?> €
	<h4>Average Bed Rate</h4> <?php echo $averageBedRate; ?> €
	<h4>Bed Occupancy Tax</h4> <?php echo $bedOccupancyTaxMonth; ?> %
</div>

<div style="width: 80%; float: right;">

	<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	
	function drawChart() {
	    var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Days');
	    data.addColumn('number', 'Sold Beds');
	    data.addColumn('number', 'Taxa de Ocupação');
	    //data.addColumn('number', 'Total Faturado');
	    data.addRows([<?php echo $graphData; ?>]);
	    var options = { title: 'Month', hAxis: {title: 'Month View',titleTextStyle: {color: 'red'}} };
	    var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function", vAxis: {maxValue: 10}} );
	    chart.draw(data, options);
	}
	</script>
	<div id="chart_div" style="width: 100%;"></div>

</div>
	  </p>
    </div>
  </div>
</div>