<?php  $this->breadcrumbs=array(
	Yii::t('contentForm','REPORT')=>array('dailyReport'),
	Yii::t('contentForm','DAILY_REPORT'),
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
    'url'=>Yii::app()->createUrl("report/dailyReport", array('day'=>date('d-m-Y', strtotime($today . ' - 1 day')))),
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
    'url'=>Yii::app()->createUrl("report/dailyReport", array('day'=>date('d-m-Y', strtotime($today . ' + 1 day')))),
)); ?>
</div>

<div style="clear: both;"></div>

<div class="alert alert-success">
	
	<h4><?php echo Yii::t('contentForm','CHECKIN'); ?></h4>
    <?php 
        echo '<table class="table_dailyReport" style="width: 100%;">';
        echo '<tr>';
        echo '<td><h5>'.Yii::t('contentForm','GUEST').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','ROOM').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','VALUE').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','STATE').'</h5></td>';
        echo '</tr>';
        foreach($dataCheckIn as $checkIn)
        {
            echo '<tr>';
            echo '<td>'.$checkIn[1] .'</td>';
            echo '<td>'.$checkIn[2] .'</td>';
            echo '<td>'.$checkIn[4] .' €</td>';
            echo '<td>' . 
            CHtml::dropDownList('id_state_' . $checkIn[0], $checkIn[5], CHtml::listData(BookingState::model()->findAll(), 'id', 'description'),
                array(
                'ajax' => array(
                    'type'=>'POST', 
                    'dataType'=>'json',
                    'data'=>array('id_booking'=>$checkIn[0], 'id_state'=>'js: $(this).val()'),
                    'url'=>CController::createUrl('booking/ajaxStateUpdate'),
                    'success'=>'function(data) {
	                    $("#state_updated_' . $checkIn[0] . '").html(data.message);
	                    $("#state_updated_' . $checkOut[0] . '").css("color","green");
	                    $("#state_updated_' . $checkIn[0] . '").fadeIn("slow");
	                    $("#state_updated_' . $checkIn[0] . '").delay(300).fadeOut("slow");
                    }',
                    'error'=>'function(data) {
	                    $("#state_updated_' . $checkIn[0] . '").html(data.message);
	                    $("#state_updated_' . $checkOut[0] . '").css("color","red");
	                    $("#state_updated_' . $checkIn[0] . '").fadeIn("slow");
	                    $("#state_updated_' . $checkIn[0] . '").delay(300).fadeOut("slow");
                    }',
                ))
            ) 
            . '<span id="state_updated_' . $checkIn[0] . '"></span></td>';
            echo '</tr>';
        }
        echo "</table>";	
        echo '<br />';
    ?>
</div>

<div style="clear: both;"></div>

<div class="alert alert-warning">
	
	<h4>Check Out</h4>
	<?php
		echo '<table class="table_dailyReport" style="width: 100%;">';
		echo '<tr>';
		echo '<td><h5>'.Yii::t('contentForm','GUEST').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','ROOM').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','VALUE').'</h5></td>';
        echo '<td><h5>'.Yii::t('contentForm','STATE').'</h5></td>';
		echo '</tr>';
		
		foreach($dataCheckOut as $checkOut)
		{
			echo '<tr>';
			echo '<td>'.$checkOut[1] .'</td>';
			echo '<td>'.$checkOut[2] .'</td>';
			echo '<td>'.$checkOut[4] .' €</td>';
			echo '<td>' . 
			CHtml::dropDownList('id_state_' . $checkOut[0], $checkOut[5], CHtml::listData(BookingState::model()->findAll(), 'id', 'description'),
				array(
				'ajax' => array(
					'type'=>'POST', 
				 	'dataType'=>'json',
				 	'data'=>array('id_booking'=>$checkOut[0], 'id_state'=>'js: $(this).val()'),
				  	'url'=>CController::createUrl('booking/ajaxStateUpdate'),
				  	'success'=>'function(data) {
				     	$("#state_updated_' . $checkOut[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","green");
				     	$("#state_updated_' . $checkOut[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkOut[0] . '").delay(300).fadeOut("slow");
				  	}',
					'error'=>'function(data) {
				     	$("#state_updated_' . $checkOut[0] . '").html(data.message);
				     	$("#state_updated_' . $checkOut[0] . '").css("color","red");
				     	$("#state_updated_' . $checkOut[0] . '").fadeIn("slow");
				     	$("#state_updated_' . $checkOut[0] . '").delay(300).fadeOut("slow");
				  	}',
				))
			) 
			. '<span id="state_updated_' . $checkOut[0] . '"></span></td>';
			echo '</tr>';		
		}
		
		echo "</table>";	
		echo '<br />';	
	?>
</div>