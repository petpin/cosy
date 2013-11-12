<?php GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
?>

<div class="well" style="margin-top: 20px">

<div style="float: left; text-align: left; width: 10%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'info',
    'size'=>'mini',
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("site/roomView", array('room'=>$idRoom, 'month'=>$previousMonth, 'year'=>$previousYear)),
)); ?>
</div>

<div style="float: left; text-align: center; width: 80%;">
<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'month', 'onchange' => 'javascript:redirect()', 'style'=>'width: 90%;')); ?> 
<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)', 'style'=>'width: 90%;')); ?>
<?php echo CHtml::dropDownList('room', $idRoom, $rooms, array('id' => 'room', 'onchange' => 'javascript:redirect()', 'style'=>'width: 90%;')); ?> 
</div>

<div style="float: left; text-align: right; width: 10%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'info',
    'size'=>'mini',
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
        echo '<tr style="text-align: center;">';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'M',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'T',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'W',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'T',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'F',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'warning', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'S',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'warning', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'S',
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

            echo '<td style="width:14%;"><div style="text-align: center;">';
            
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
                    	/*$idBooking[] = $bookingDay->Booking->id;
                        $lableDiv[] = $bookingDay->Booking->bookingGuest[0]->guest->name;
                        $numNightBooking[] = $bookingDay->Booking->night_num;
                        $guestUrl[] = Yii::app()->createUrl('guest/view', array('id' => $bookingDay->Booking->bookingGuest[0]->guest->id));
                        $bookingBeds[] = $bookingDay->bed_num;
                        $stateItem[] = $bookingDay->Booking->bookingState->description;
                        $viewUrl[] = Yii::app()->createUrl('booking/view', array('id' => $bookingDay->Booking->id));
                        $updateUrl[] = Yii::app()->createUrl('booking/update', array('id' => $bookingDay->Booking->id));
                        $supplierInfo[] = $bookingDay->Supplier->name;
                        $supplierUrl[] = Yii::app()->createUrl('supplier/view', array('id' => $bookingDay->Supplier->id));

                        $GLOBALS["camasVendidas"] = $GLOBALS["camasVendidas"] + 1;*/
                        
                        $idBooking[] = $bookingDay->Booking->id;
                        $numNightBooking[] = $bookingDay->Booking->night_num;
                        $lableDiv[] = $bookingDay->Booking->bookingGuest[0]->guest->name;
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
				        'type'=>$bookingLists[$idBooking[$key]], // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				        //'icon'=>'remove white',
				        'size'=>'mini',
				        'buttons'=>array(
				            array('label'=>'', /*'icon'=>'remove white',*/ 'items'=>array(
				                //array('label'=>'' . $bookingBeds[$key] . ' bed(s)'),
				                //array('label'=>'' . $numNightBooking[$key] . ' day(s)'),
				                array('label'=>Yii::t('contentForm','CLIENT')),
				                array('label'=>$value, 'url'=>$guestUrl[$key]),
				                array('label'=>Yii::t('contentForm','STATE').' - ' . $stateItem[$key]),
				                array('label'=>Yii::t('contentForm','SUPPLIER')),
				                array('label'=>$supplierInfo[$key], 'url'=>$supplierUrl[$key]),
				                '---',
				                array('label'=>Yii::t('contentForm','BOOKING')),
				                array('label'=>Yii::t('contentForm','VIEW'), 'url'=>$viewUrl[$key]),
				                array('label'=>Yii::t('contentForm','EDIT'), 'url'=>$updateUrl[$key]),
				            	),
				            ),
				        ),
				    ));
			    
			    ?></span><?php
            }

            for($i=count($lableDiv); $i < $specificRoom->bed_num; $i++)
            {
            	?><span style="text-align: left;"><?php
            	
			    $this->widget('bootstrap.widgets.TbButtonGroup', array(
			        'type'=>'success',
			        'size'=>'mini',
			        'buttons'=>array(
			            array('label'=>'', 'items'=>array(
			                array('label'=>Yii::t('contentForm','CREATE'), 'url'=>Yii::app()->createUrl('booking/create', array('room' => $room->id, 'start_date' => $currentDate))),
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

        echo "</tr>";
        
        echo '<tr style="text-align: center;">';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'M',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'T',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'W',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>'T',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse',
			    'label'=>'F',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'warning',
			    'label'=>'S',
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'warning',
			    'label'=>'S',
			));
        
        echo '</th>';
        echo '</tr>';
        
        echo "</table><br />";
        ?>
        
        <?php $percentagemOcupacao = (int)(( $camasVendidas * 100 ) / (($day_num - 1) * $specificRoom->bed_num)); ?>
        
		<h4><?php echo Yii::t('contentForm','SOLD') . ' ' . $camasVendidas . ' ' . Yii::t('contentForm','BEDS'); ?></h4>
		
		<div style="clear: both; padding-top: 10px;"></div>

		<?php $this->widget('bootstrap.widgets.TbLabel', array(
		    'type'=>'warning',
		    'label'=>Yii::t('contentForm','OCUPATION_RATE') .' '. $percentagemOcupacao . '%',
		)); ?>
		
		<div style="height: 5px;"></div>
		
		<?php $this->widget('bootstrap.widgets.TbProgress', array(
		    'type'=>'active',
		    'percent'=>$percentagemOcupacao,
		    'striped'=>false,
		    'animated'=>false,
		)); ?>
		<?php
	}
	else
        echo 'You need to insert a room first !';
}
?>
</div>


