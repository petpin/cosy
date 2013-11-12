<?php $this->breadcrumbs=array(
	Yii::t('contentForm','REPORT')=>array('year'),
	Yii::t('contentForm','YEAR'),
);

Yii::app()->clientScript->registerCoreScript('jquery'); 
$ourscript = 'function redirect() { parent.location = \'index.php?r=report/year&year=\' + $(\'#year\').val(); }';
Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);
?>

<div style="float: left; text-align: right; width: 10%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/year", array('year'=>($year-1))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 80%;">
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '('.Yii::t('contentForm','SELECT_A_YEAR').')', 'style'=>'width: 90%;')); ?>
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

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChart);
	  
	  function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', <?php echo json_encode(Yii::t('contentForm','MONTH')); ?>);
		data.addColumn('number', <?php echo json_encode(Yii::t('contentForm','SOLD_BEDS')); ?>);
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
	<h4><?php echo Yii::t('contentForm','SOLD_BEDS'); ?></h4> <?php echo $totalCamasVendidas; ?> <?php echo Yii::t('contentForm','BEDS'); ?>
	<h4><?php echo Yii::t('contentForm','VALUE'); ?></h4> <?php echo $totalFaturado; ?> €
	<h4><?php echo Yii::t('contentForm','VALUE_WITHOUT_RATES'); ?></h4> <?php echo $totalFaturadoSemRate; ?> €
	<h4><?php echo Yii::t('contentForm','AVERAGE_BED_RATE'); ?></h4> <?php echo $averageBedRate; ?> €
	<h4><?php echo Yii::t('contentForm','BED_OCCUPANCY_TAX'); ?></h4> <?php echo $bedOccupancyTaxYear; ?> %
</div>