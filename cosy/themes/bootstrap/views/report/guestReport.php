<?php  $this->breadcrumbs=array(
	'Report'=>array('guestReport'),
	'Guest Report',
);

date_default_timezone_set('Europe/Lisbon');

Yii::app()->clientScript->registerCoreScript('jquery'); 
$ourscript = 'function redirect() { parent.location = \'index.php?r=report/supplierBooking&year=\' + $(\'#year\').val(); }';
Yii::app()->clientScript->registerScript('releaseRedirect', $ourscript, CClientScript::POS_HEAD);
?>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("report/guestReport", array('day'=>date('d-m-Y', strtotime($today . ' - 1 day')))),
)); ?>
</div>

<div style="float: left; text-align: center; width: 70%;">
	<h4><b><?php echo $today;?></b></h4>
</div>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("report/guestReport", array('day'=>date('d-m-Y', strtotime($today . ' + 1 day')))),
)); ?>
</div>

<div class="alert alert-info" style="width: 100%; float: left;">
<!--<div style="padding-left: 20px; padding-right: 20px;">-->
	
	<?php
		echo '<table class="table_dailyReport" style="width: 100%;">';
		echo '<tr>';
		echo '<td><h5>Guest</h5></td>';
        echo '<td><h5>Room</h5></td>';
        echo '<td><h5>Beds</h5></td>';
        echo '<td><h5>Start Date</h5></td>';
        echo '<td><h5>End Date</h5></td>';
        echo '<td><h5>State</h5></td>';
		echo '</tr>';
		foreach($dataCheckIn as $checkIn)
		{
			echo '<tr>';
			echo '<td class="table_dailyReport_td">'.$checkIn[1] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[2] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[3] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[4] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[5] .'</td>';
			echo '<td class="table_dailyReport_td">'.$checkIn[6] .'</td>';
			echo '</tr>';
		}
		echo "</table>";	
		echo '<br />';
	?>
	
</div>
