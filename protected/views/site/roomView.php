<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/booking.js'
);
?>

<?php GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MONTH_VIEW'),
    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("site/excelView", array('room'=>$idRoom, 'month'=>$month, 'year'=>$year)),
)); ?>

	<?php
	if(count($rooms) > 0)
	{
	?>
	
	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'bookingModal')); ?>
	
	    <div class="modal-header">
	        <a class="close" data-dismiss="modal">&times;</a>
	        <h4 id="modalTitle"></h4>
	    </div>
	 
	    <div class="modal-body" id="testeAjaxView"></div>
	 
	    <div class="modal-footer">
	    	<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type' => 'primary',
				'label' => Yii::t('contentForm','CREATE'),
				'htmlOptions' => array(
					'id' => 'createModalAjaxButton',
					'onclick' => '$("#bookingForm").submit();'
				),
			)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type' => 'primary',
				'label' => Yii::t('contentForm','UPDATE_1'),
				'htmlOptions' => array(
					'id' => 'updateModalAjaxButton',
					'onclick' => '$("#bookingForm").submit();'
				),
			)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'label' => Yii::t('contentForm', 'CLOSE'),
				'url' => '#',
				'htmlOptions' => array('data-dismiss' => 'modal'),
			)); ?>
	    </div>
	 
	<?php $this->endWidget(); ?>
		
	<?php 
	/*
	 *	Este botão escondido ('style' => 'display:none;',) serve para a abrir a janela do modal
	 *	No ficheiro javascript (booking.js) é simulado um click neste - $('#buttonModal').click();
	 */
	$this->widget('bootstrap.widgets.TbButton', array(
		'label' => Yii::t('contentForm', 'CLICK_ME'),
		'type' => 'primary',
		'htmlOptions' => array(
			'id' => 'buttonModal',
			'data-toggle' => 'modal',
			'data-target' => '#bookingModal',
			'style' => 'display:none;',
		),
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
	<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '('.Yii::t('contentForm','SELECT_A_YEAR').')')); ?>
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
			    'label'=>Yii::t('contentForm','MONDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','TUESDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','WEDNESDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','THRUSDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','FRIDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','SATURDAY'),
			));
        
        echo '</th>';
        echo '<th style="width:14%;">';
        
	        $this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
			    'label'=>Yii::t('contentForm','SUNDAY'),
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
			        'type'=>$bookingLists[$idBooking[$key]],
			        'size'=>'small',
			        'buttons'=>array(
			            array(
			            	'label'=>'',
			            	'items'=>array(
				                array('label'=>Yii::t('contentForm','BOOKING').' - ' . $bookingBeds[$key] . ' '.Yii::t('contentForm','BED').'(s) '.Yii::t('contentForm','FOR').' ' . $numNightBooking[$key] . ' '.Yii::t('contentForm','DAY').'(s)'),
				                array('label'=>Yii::t('contentForm','VIEW'), 'url'=>'javascript:viewBooking(\'' . $idBooking[$key] . '\', \'testeAjaxView\', \'' . Yii::t('contentForm', 'VIEW_BOOKING') . '\');'), //, '.Yii::t('contentForm','TEST').'
				                array('label'=>Yii::t('contentForm','EDIT'), 'url'=>'javascript:updateBooking(\'' . $idBooking[$key] . '\', \'testeAjaxView\', \'' . Yii::t('contentForm', 'UPDATE_BOOKING') . '\');'),
				                array('label'=>Yii::t('contentForm','CLIENT')),
				                array('label'=>$value, 'url'=>$guestUrl[$key]),
				                array('label'=>Yii::t('contentForm','STATE').' - ' . $stateItem[$key]),
				                array('label'=>Yii::t('contentForm','SUPPLIER') . ' - ' . $supplierInfo[$key]),
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
			        'size'=>'small',
			        'buttons'=>array(
			            array('label'=>'', 'items'=>array(
			                array('label'=>Yii::t('contentForm','CREATE'), 'url'=>Yii::app()->createUrl('booking/create', array('room' => $specificRoom->id, 'start_date' => $currentDate))),
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
		    'striped'=>true,
		    'animated'=>true,
		)); ?>
		<?php
	}
	else
        echo '<br /><br />You need to insert a room first !';
}
?>
</div>
