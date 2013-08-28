<?php 
echo/*$this->breadcrumbs=array(
	'Room'=>array('roomView'),
	'View',
);*/

/* Get Rooms */
$rooms = Room::model()->findAll();

$idRoom = $rooms[0]->id;

if( isset($_GET["room"]) ) $idRoom = $_GET["room"];
?>

<p><?php Yii::app()->clientScript->registerCoreScript('jquery'); 

GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
	echo CHtml::link('Month View',array('site/excelView')) . '</p>';
	
	if(count($rooms) > 0)
	{
            $camasVendidas = 0;

            $ourscript = 'function redirect() {
                parent.location = \'index.php?r=site/roomView&room=\' + $(\'#room\').val() + \'&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
            }';

            Yii::app()->clientScript->registerScript('releaseRedirect', $ourscript, CClientScript::POS_HEAD);

            function meteCamas3($room, $day)
            {
                $toReturn = '';
                $toReturn .= '<td style="width:14%;">';

                // Variaveis para quartos reservados
                $lableDiv = array();
                $url = array();
                $style = array();

                $criteria = new CDbCriteria;
                $criteria->condition='day=:day'; $criteria->params=array(':day'=>$day);

                $bookingDays = BookingDays::model()->findAll($criteria);

                foreach ($bookingDays as $bookingDay)
                {
                    if(isset($bookingDay->id_booking))
                    {
                        if($bookingDay->id_room == $room->id)
                        {
                            for($i = 0; $i < $bookingDay->bed_num; $i++)
                            {
                                $lableDiv[] = $bookingDay->Booking->bookingGuest[0]->guest->name . ' (' . $bookingDay->Booking->bookingState->description . ')';
                                $url[] = Yii::app()->createUrl('booking/view', array('id' => $bookingDay->Booking->id));
                                $style[] = ' icon_calendar_light_red';

                                $GLOBALS["camasVendidas"] = $GLOBALS["camasVendidas"] + 1;
                            }
                        }
                    }
                }

                foreach ($lableDiv as $key => $value)
                {
                    $toReturn .= '<a title="' . $value . '" href="' . $url[$key] . '"><div class="icon_calendar' . $style[$key] . '"></div></a>';
                }

                for($i=count($lableDiv); $i < $room->bed_num; $i++)
                {
                    $toReturn .= '<a title="Free Spot" href="';
                    $toReturn .= Yii::app()->createUrl('booking/create', array('room' => $room->id, 'start_date' => $day)) . '">';
                    $toReturn .= '<div class="icon_calendar icon_calendar_light_green"></div></a>';
                }

                unset($lableDiv);

                $toReturn .= '</td>';

                return $toReturn;
            }

            /* Get Rooms */
            $criteria = new CDbCriteria;
            $criteria->condition='id=:id';
            $criteria->params=array(':id'=>$idRoom);

            $specificRoom = Room::model()->find($criteria);

            //This gets today's date
            $date = time() ;

            $month = date('m', $date);
            $year = date('Y', $date);

            echo '<select id="room" onchange="javascript:redirect()">';
            foreach ($rooms as $room)
            {
                echo '<option value="' . $room->id . '"';
                if($room->id == $_GET["room"]) { echo " selected='selected' "; }
                echo '>' . $room->title . '</option>';
            }
            echo '</select>';

            $months = array(array("01","January"), array("02","February"), array("03","March"), array("04","April"), 
                            array("05","May"), array("06","June"), array("07","July"), array("08","August"), 
                            array("09","September"), array("10","October"), array("11","Novemeber"), array("12","December"),);

            echo '<select id="month" onchange="javascript:redirect()">';
            foreach ($months as $monthname)
            {
                echo '<option value="' . $monthname[1] . '"';

                if($monthname[1] == $_GET["month"]) { echo " selected='selected' ";  $month = $monthname[0]; }
                else if($monthname[0] == $month) { echo " selected='selected' "; }

                echo '>' . $monthname[1] . '</option>';
            }
            echo '</select>';

            echo '<select id="year" onchange="javascript:redirect()">';
            for ($i_year = 0; $i_year < 3; $i_year++)
            {
                $currentYear = ($year + $i_year);

                echo '<option value="' . $currentYear . '"';
                if($currentYear == $_GET["year"]) { echo " selected='selected' "; $year = $currentYear; }
                echo '>' . $currentYear . '</option>';
            }
            echo '</select>';

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
            
            //This counts the days in the week, up to 7
            $day_count = 1;
            
            //Here we start building the table heads
            ?>
            </p>
            <table id="calendar" class="calendar" border="1">
	            <tr class="calendar_weekend">
		            <th style="width:14%;">Monday</th>
		            <th style="width:14%;">Tuesday</th>
		            <th style="width:14%;">Wednesday</th>
		            <th style="width:14%;">Thursday</th>
		            <th style="width:14%;">Friday</th>
		            <th style="width:14%;">Saturday</th>
		            <th style="width:14%;">Sunday</th>
	            </tr>
            	<tr>
            <?php
            //first we take care of those blank days
            while ( $blank > 0 )
            {
                ?><td style="width:14%;"></td><?php
                $blank = $blank - 1;
                $day_count++;
            }

            //sets the first day of the month to 1
            $day_num = 1;

            //count up the days, untill we've done all of them in the month
            while ( $day_num <= $days_in_month )
            {
                if($day_num < 10)
                    $day_num = '0' . $day_num;
                
				?>
                <td style="width:14%;"><?php echo $day_num; ?><br />
	                <table style="border: 0px solid black;">
	                	<tr><?php echo meteCamas3($specificRoom, ($year . '-' . $month . '-' . $day_num) ); ?></tr>
	                </table>
                </td>
                <?php
                $day_num++;
                $day_count++;

                //Make sure we start a new row every week
                if ($day_count > 7)
                {
                    ?></tr><tr><?php
                    $day_count = 1;
                }
            }
            //Finaly we finish out the table with some blank details if needed
            while ( $day_count >1 && $day_count <=7 )
            {
                ?><td> </td><?php
                $day_count++;
            }

            ?></tr></table><?php

            echo 'Sold beds: '. $camasVendidas;
	}
	else
        echo 'You need to insert a room first !';
}
?></p>
