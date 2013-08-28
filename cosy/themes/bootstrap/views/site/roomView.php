<?php GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Month View',
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("site/excelView", array('room'=>$idRoom, 'month'=>$month, 'year'=>$year)),
)); ?>

<div class="well" style="margin-top: 20px">

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("site/roomView", array('room'=>$idRoom, 'month'=>$previousMonth, 'year'=>$previousYear)),
)); ?>
</div>

<div style="float: left; text-align: center; width: 70%;">
<?php echo CHtml::dropDownList('room', $idRoom, $rooms, array('id' => 'room', 'onchange' => 'javascript:redirect()')); ?> 
<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'month', 'onchange' => 'javascript:redirect()')); ?> 
<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)')); ?>
</div>

<div style="float: left; text-align: center; width: 15%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'small', // null, 'large', 'small' or 'mini'
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("site/roomView", array('room'=>$idRoom, 'month'=>$nextMonth, 'year'=>$nextYear)),
)); ?>
</div>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<?php
	if(count($rooms) > 0)
	{
        $camasVendidas = 0;

        $ourscript = 'function redirect() { parent.location = \'index.php?r=site/roomView&room=\' + $(\'#room\').val() + \'&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val(); }';
        Yii::app()->clientScript->registerScript('releaseRedirect', $ourscript, CClientScript::POS_HEAD);

        //Here we generate the first day of the month
        $first_day = mktime(0,0,0,$month, 1, $year) ;
        //Here we find out what day of the week the first day of the month falls on
        $day_of_week = date('D', $first_day) ;
        //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero
        switch($day_of_week){
            case "Mon": $blank = 0; break;
            case "Tue": $blank = 1; break;
            case "Wed": $blank = 2; break;
            case "Thu": $blank = 3; break;
            case "Fri": $blank = 4; break;
            case "Sat": $blank = 5; break;
            case "Sun": $blank = 6; break;
        }
        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $month, $year) ;
        //Here we start building the table heads
        echo '</p><table id="calendar" class="calendar" style="width: 100%;">';
        echo '<tr>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Monday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Tuesday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Wednesday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Thursday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Friday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Saturday',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'Sunday',
			));
        
        echo '</th>';
        echo '</tr>';
        //This counts the days in the week, up to 7
        $day_count = 1;

        echo "<tr>";

        //first we take care of those blank days
        while ( $blank > 0 )
        {
            echo '<td style="width:14%;"></td>';
            $blank = $blank - 1;
            $day_count++;
        }

        //sets the first day of the month to 1
        $day_num = 1;
        $colorNum = 0;
        
        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            if($day_num < 10)
                $day_num = '0' . $day_num;

            echo '<td style="width:14%;"><div>';
            
            $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>(int)$day_num,
			));
            
            ?></div><div style="text-align: center;"><?php
            echo '<table>';
            echo '<tr>';
            echo '<td style="width:14%;">';
            
            // Variaveis para quartos reservados
            $currentDate = $year . '-' . $month . '-' . $day_num;
            $lableDiv = array();
            $url = array();

            $criteria = new CDbCriteria;
            $criteria->condition='day=:day AND id_room=:idRoom';
            $criteria->params=array(':day'=>$currentDate, ':idRoom'=>$idRoom);
            $bookingDays = BookingDays::model()->findAll($criteria);

            foreach ($bookingDays as $bookingDay)
            {
                if(isset($bookingDay->id_booking))
                {
                    for($i = 0; $i < $bookingDay->bed_num; $i++)
                    {
                    	$idBooking[] = $bookingDay->Booking->id;
                        $lableDiv[] = $bookingDay->Booking->bookingGuest[0]->guest->name;
                        $numNightBooking[] = $bookingDay->Booking->night_num;
                        $guestUrl[] = Yii::app()->createUrl('guest/view', array('id' => $bookingDay->Booking->bookingGuest[0]->guest->id));
                        $bookingBeds[] = $bookingDay->bed_num;
                        $stateItem[] = $bookingDay->Booking->bookingState->description;
                        $viewUrl[] = Yii::app()->createUrl('booking/view', array('id' => $bookingDay->Booking->id));
                        $updateUrl[] = Yii::app()->createUrl('booking/update', array('id' => $bookingDay->Booking->id));
                        $supplierInfo[] = $bookingDay->Supplier->name;
                        $supplierUrl[] = Yii::app()->createUrl('supplier/view', array('id' => $bookingDay->Supplier->id));

                        $GLOBALS["camasVendidas"] = $GLOBALS["camasVendidas"] + 1;
                    }
                }
            }

            foreach ($lableDiv as $key => $value)
            {
            	if($bookingLists[$idBooking[$key]] == "")
            	{
            		$bookingLists[$idBooking[$key]] = $colors[$colorNum];
            		
            		if($colorNum == (count($colors) - 1))
	            	{
	            		$colorNum=0;
	            	}
	            	else
	            	{
	            		$colorNum++;
	            	}
            	}
            	
            	?><span style="text-align: left;"><?php
            	
            	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			        'type'=>$bookingLists[$idBooking[$key]],
			        'size'=>'small',
			        'buttons'=>array(
			            array('label'=>'', /*'icon'=>'remove white',*/ 'items'=>array(
			                array('label'=>'Client'),
			                array('label'=>$value, 'url'=>$guestUrl[$key]),
			                array('label'=>'Booking - ' . $bookingBeds[$key] . ' bed(s) for ' . $numNightBooking[$key] . ' day(s)'),
			                array('label'=>'View', 'url'=>$viewUrl[$key]),
			                array('label'=>'Edit', 'url'=>$updateUrl[$key]),
			                array('label'=>$stateItem[$key]),
			                array('label'=>'Supplier'),
			                array('label'=>$supplierInfo[$key], 'url'=>$supplierUrl[$key]),
			            ), ),
			        ),
			    ));
			    
			    ?></span><?php
            }

            for($i=count($lableDiv); $i < $specificRoom->bed_num; $i++)
            {
            	?><span style="text-align: left;"><?php
            	
            	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			        'type'=>'success',
			        'size'=>'small',
			        'buttons'=>array(
			            array('label'=>'', 'items'=>array(
			                array('label'=>'Create', 'url'=>Yii::app()->createUrl('booking/create', array('room' => $specificRoom->id, 'start_date' => $currentDate))),
			            ), ),
			        ),
			    ));
			    
			    ?></span><?php
            }

			unset($idBooking);
            unset($lableDiv);
	        unset($bookingBeds);
	        unset($numNightBooking);
			
            echo '</td>';
            echo '</tr>';
            echo '</table></div>';
            echo '</td>';

            $day_num++;
            $day_count++;

            //Make sure we start a new row every week
            if ($day_count > 7)
            {
                echo "</tr><tr>";
                $day_count = 1;
            }
        }
        //Finaly we finish out the table with some blank details if needed
        while ( $day_count >1 && $day_count <=7 )
        {
            echo "<td> </td>";
            $day_count++;
        }

        echo "</tr></table><br />";
        ?>
        
        <?php $percentagemOcupacao = (int)(( $camasVendidas * 100 ) / (($day_num - 1) * $specificRoom->bed_num)); ?>
        
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Resumo',
		    'type'=>'danger',
		    'htmlOptions'=>array('data-title'=>'Resumo Mensal', 'data-content'=>'Foram vendidas ' . $camasVendidas . ' camas.', 'rel'=>'popover'),
		));?>
		
		<div style="clear: both; padding-top: 30px;"></div>

		<?php $this->widget('bootstrap.widgets.TbLabel', array(
		    'type'=>'warning',
		    'label'=>'Taxa de Ocupação ' . $percentagemOcupacao . '%',
		)); ?>
		
		<div style="height: 5px;"></div>
		
		<?php $this->widget('bootstrap.widgets.TbProgress', array(
		    'type'=>'active',
		    'percent'=>$percentagemOcupacao,
		    'striped'=>true,
		    'animated'=>true,
		)); ?>
		<?php
	}
	else
        echo 'You need to insert a room first !';
}
?>
</div>


