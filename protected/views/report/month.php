<?php $this->breadcrumbs=array(
	Yii::t('contentForm','REPORT')=>array('month'),
	Yii::t('contentForm','MONTH'),
);

Yii::app()->clientScript->registerCoreScript('jquery'); 
$ourscript = 'function redirect() { parent.location = \'index.php?r=report/month&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val(); }';
Yii::app()->clientScript->registerScript('releaseRedirect', $ourscript, CClientScript::POS_HEAD);
?>

<div style="float: left; text-align: right; width: 20%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/month", array('month'=>($month-1), 'year'=>$year)),
)); ?>
</div>

<div style="float: left; text-align: center; width: 60%;">
	<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'month', 'onchange' => 'javascript:redirect()')); ?> 
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '('.Yii::t('contentForm','SELECT_A_YEAR').')')); ?>
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
	<h4><?php echo Yii::t('contentForm','SOLD_BEDS'); ?></h4> <?php echo $totalCamasVendidas.' '.Yii::t('contentForm','BEDS'); ?> 
	<h4><?php echo Yii::t('contentForm','VALUE'); ?></h4> <?php echo $totalFaturado; ?> €
	<h4><?php echo Yii::t('contentForm','VALUE_WITHOUT_RATES'); ?></h4> <?php echo $totalFaturadoSemRate; ?> €
	<h4><?php echo Yii::t('contentForm','AVERAGE_BED_RATE'); ?></h4> <?php echo $averageBedRate; ?> €
	<h4><?php echo Yii::t('contentForm','BED_OCUPANCY_TAX'); ?></h4> <?php echo $bedOccupancyTaxMonth; ?> %
</div>

<div style="width: 80%; float: right;">

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	
	function drawChart() {
	    var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Days');
	    data.addColumn('number', <?php echo json_encode(Yii::t('contentForm','SOLD_BEDS')); ?>);
	    data.addColumn('number', <?php echo json_encode(Yii::t('contentForm','OCUPANCY_TAX')); ?>);
	    //data.addColumn('number', 'Total Faturado');
	    data.addRows([<?php echo $graphData; ?>]);
	    var options = { title: 'Month', hAxis: {title: 'Month View',titleTextStyle: {color: 'red'}} };
	    var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function", vAxis: {maxValue: 10}} );
	    chart.draw(data, options);
	}
	</script>
	<div id="chart_div" style="width: 100%;"></div>

</div>