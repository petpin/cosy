<?php //$this->pageTitle=Yii::app()->name; 

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/booking.js'
);

GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{

/*$this->breadcrumbs=array(
	'Month'=>array('excelView'),
	//'View - ' . CHttpRequest::getUserHostAddress(),
);*/
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=> Yii::t('contentForm','ROOM_VIEW'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("site/roomView", array('room'=>$idRoom, 'month'=>$month, 'year'=>$year)),
)); ?>

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'bookingModal')); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4 id="modalTitle"></h4>
    </div>
 
    <div class="modal-body" id="testeAjaxView"></div>
 
    <div class="modal-footer">
		<?php /*$this->widget('bootstrap.widgets.TbButton', array(
			'type' => 'primary',
			'label' => 'Update',
			'url' => '#',
			'htmlOptions' => array('data-dismiss' => 'modal'),
		));*/ ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label' => Yii::t('contentForm','CLOSE'),
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
		'label' => Yii::t('contentForm','CLICK_ME'),
		'type' => 'primary',
		'htmlOptions' => array(
			'id' => 'buttonModal',
			'data-toggle' => 'modal',
			'data-target' => '#bookingModal',
			'style' => 'display:none;',
		),
	)); ?>

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<div class="well" style="margin-top: 20px">

<div style="float: left; text-align: center; width: 25%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'info',
    'size'=>'small',
    'icon'=>'backward white',
    'url'=>Yii::app()->createUrl("site/excelView", array('month'=>$previousMonth, 'year'=>$previousYear)),
)); ?>
</div>

<div style="float: left; text-align: center; width: 50%;">
<?php echo CHtml::dropDownList('month', $month, $months, array('id' => 'month', 'onchange' => 'javascript:redirect()')); ?> 
<?php echo CHtml::dropDownList('year', $year, $years, array('id' => 'year', 'onchange' => 'javascript:redirect()', 'empty' => '(Select a year)')); ?>
</div>

<div style="float: left; text-align: center; width: 25%;">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'info',
    'size'=>'small',
    'icon'=>'forward white',
    'url'=>Yii::app()->createUrl("site/excelView", array('month'=>$nextMonth, 'year'=>$nextYear)),
)); ?>
</div>

<?php 
    if(count($rooms) > 0)
    {
        $camasVendidas = 0;

        $ourscript = 'function redirect() {
        	if($(\'#month\').val() != 0)
            	parent.location = \'index.php?r=site/excelView&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
        }';

        Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $month, $year) ;

        echo '<table class="calendar">';
        echo '<tr>';
        echo '<th style="padding-bottom: 10px">';
        
        $this->widget('bootstrap.widgets.TbLabel', array(
		    'type'=>'info',
		    'label'=> Yii::t('contentForm', 'ROOM')
		));
        
        echo '</th>';

        $day_num = 1;

        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            $currentDate = $year . '-' . $month . '-' . $day_num;

            $day_num_week = date("D", strtotime($currentDate));

            if($day_num < 10)
                $day_num = '0' . $day_num;

            if($day_num_week == "Sat" or $day_num_week == "Sun")
            {
            	$typeTbLabel = 'warning';
            }
            else
            {
            	$typeTbLabel = 'inverse';
            }
            
			echo '<th style="padding-bottom: 10px">';
			
			$this->widget('bootstrap.widgets.TbLabel', array(
			    'type'=>$typeTbLabel,
			    'label'=>(int)$day_num,
			));
			
			echo '</th>';

            $day_num++;
        }

        echo "</tr>";

        $day_num = 1;
        $colorNum = 0;

        foreach($rooms as $room)
        {
            echo '<tr>';
            echo '<td style="text-align: right">';
            
            $this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>$room->title,
			    'type'=>'inverse',
			    'htmlOptions'=>array('data-title'=>'Resumo Mensal', 'data-content'=>'Room Type: ' . $room->roomType->description . ' Bed Number: ' . $room->bed_num, 'rel'=>'popover'),
			));
			
			echo '</td>';

            while ( $day_num <= $days_in_month )
            {
                $currentDate = $year . '-' . $month . '-' . $day_num;

                $day_num_week = date("D", strtotime($currentDate));

				echo '<td ';
				
                if($day_num_week == "Sat" or $day_num_week == "Sun")
                    echo ' class="alert-info" ';
                
                echo 'style="text-align: center;">';
                
                // Variaveis para quartos reservados
	            $lableDiv = array();
	            $url = array();
	
	            $criteria = new CDbCriteria;
	            $criteria->condition='day=:day AND id_room=:idRoom';
	            $criteria->params=array(':day'=>$currentDate, ':idRoom'=>$room->id);
	            $bookingDays = BookingDays::model()->findAll($criteria);
	
	            foreach ($bookingDays as $bookingDay)
	            {
	                if(isset($bookingDay->id_booking))
	                {
                        for($i = 0; $i < $bookingDay->bed_num; $i++)
                        {
                            /*Guest::model()->findByPk($bookingGuest->id_guest)->name*/
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
	            	
	            	//echo ' - ' . $idBooking[$key] . ' - ' . $bookingLists[$idBooking[$key]] . '<br />';
	            	
	            	?><span style="text-align: left;"><?php
            	
	            	$this->widget('bootstrap.widgets.TbButtonGroup', array(
				        'type'=>$bookingLists[$idBooking[$key]], // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				        //'icon'=>'remove white',
				        'size'=>'mini',
				        'buttons'=>array(
				            array('label'=>'', /*'icon'=>'remove white',*/ 'items'=>array(
				                array('label'=>Yii::t('contentForm','SUMMARY') .' - ' . $bookingBeds[$key] . ' bed(s) for ' . $numNightBooking[$key] . ' day(s)'),
				                array('label'=>Yii::t('contentForm','VIEW'), 'url'=>$viewUrl[$key]),
				                array('label'=>Yii::t('contentForm','VIEW_AJAX'), 'url'=>'javascript:viewBooking(\'' . $idBooking[$key] . '\', \'testeAjaxView\');'),
				                array('label'=>Yii::t('contentForm','EDIT'), 'url'=>$updateUrl[$key]),
				                array('label'=>Yii::t('contentForm','UPDATE_AJAX'), 'url'=>'javascript:updateBooking(\'' . $idBooking[$key] . '\', \'testeAjaxView\');'),
				                array('label'=>Yii::t('contentForm','STATE') .' - ' . $stateItem[$key]),
				                array('label'=>Yii::t('contentForm','CLIENT')),
				                array('label'=>$value, 'url'=>$guestUrl[$key]),
				                array('label'=>Yii::t('contentForm','SUPPLIER')),
				                array('label'=>$supplierInfo[$key], 'url'=>$supplierUrl[$key]),
				            	),
				            ),
				        ),
				    ));
				    
				    ?></span><?php
	            }
	
	            for($i=count($lableDiv); $i < $room->bed_num; $i++)
	            {
	            	$camasLivres++;
	            	
	            	?><span style="text-align: left;"><?php
            		
	            	$this->widget('bootstrap.widgets.TbButtonGroup', array(
				        'type'=>'success',
				        'size'=>'mini',
				        'buttons'=>array(
				            array('label'=>'', 'items'=>array(
				                //array('label'=>Yii::t('contentForm', 'CREATE'), 'url'=>Yii::app()->createUrl('booking/create', array('room' => $room->id, 'start_date' => $currentDate))),
				                array('label'=>Yii::t('contentForm', 'CREATE'), 'url'=>'javascript:createBooking(\'testeAjaxView\', \'' . $room->id . '\', \'' . $currentDate . '\', \'' . Yii::t('contentForm', 'EJDJS') . '\');'),
				            ), ),
				        ),
				    ));
				    
				    ?></span><?php
	            }
	
	            unset($idBooking);
	            unset($lableDiv);
	            unset($bookingBeds);
	            unset($numNightBooking);
	            unset($stateItem);
	            unset($viewUrl);
	            unset($guestUrl);
	            unset($supplierInfo);
	            unset($supplierUrl);

                echo '</td>';

                $day_num++;
            }

            echo '</tr>';
            
            echo '<tr><td colspan="' . $days_in_month . '" style="height: 5px;"></td></tr>';

            $day_num = 1;
        }

        echo "</table><br />";
        
        $percentagemOcupacao = (int)( $camasVendidas / $camasLivres * 100 );
		
		$this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>yii::t('contentForm','SUMMARY'),
		    'type'=>'danger',
		    'htmlOptions'=>array('data-title'=>'Resumo Mensal', 'data-content'=>'Foram vendidas ' . $camasVendidas . ' camas', 'rel'=>'popover'),
		));
		
		?>
		<div style="clear: both; padding-top: 30px;"></div>

		<?php $this->widget('bootstrap.widgets.TbLabel', array(
		    'type'=>'info',
		    'label'=>yii::t('contentForm','OCUPATION_RATE') . ' ' . $percentagemOcupacao . '%',
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
