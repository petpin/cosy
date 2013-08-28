<?php $this->pageTitle=Yii::app()->name; 

$this->breadcrumbs=array(
	'Month'=>array('excelView'),
	'View',
);
?>

<p><?php Yii::app()->clientScript->registerCoreScript('jquery'); 

GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
    echo CHtml::link('Room View', array('site/roomView')) . '</p>';
    
    /* Get Rooms */
    $rooms = Room::model()->findAll();

    if(count($rooms) > 0)
    {
        $camasVendidas = 0;

        $ourscript = 'function redirect() {
                parent.location = \'index.php?r=site/excelView&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
            }';

        Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

        function meteCamas($room, $day)
        {
            $toReturn = '';

            // Variaveis para quartos reservados
            $lableDiv = array();
            $url = array();
            $style = array();

            $criteria = new CDbCriteria;

            $criteria->condition='day=:day';
            $criteria->params=array(':day'=>$day);
            $bookingDays = BookingDays::model()->findAll($criteria);

            foreach ($bookingDays as $bookingDay)
            {
                if(isset($bookingDay->id_booking))
                {
                    if($bookingDay->id_room == $room->id)
                    {
                        for($i = 0; $i < $bookingDay->bed_num; $i++)
                        {
                            /*Guest::model()->findByPk($bookingGuest->id_guest)->name*/
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
                $toReturn .= '<a title="' . $value . '" href="' . $url[$key] . '"><div class="icon_calendar_mini' . $style[$key] . '"></div></a>';
            }

            for($i=count($lableDiv); $i < $room->bed_num; $i++)
            {
                $toReturn .= '<a title="Free Spot" href="';
                $toReturn .= Yii::app()->createUrl('booking/create', array('room' => $room->id, 'start_date' => $day)) . '">';
                $toReturn .= '<div class="icon_calendar_mini icon_calendar_light_green"></div></a>';
            }

            unset($lableDiv);

            return $toReturn;
        }

        /* Get Rooms */		
        $rooms = Room::model()->findAll();

        //This gets today's date
        $date = time() ;

        $month = date('m', $date);
        $year = date('Y', $date);

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
			else if($currentYear == $year) { echo " selected='selected' "; $year = $currentYear; }
            echo '>' . $currentYear . '</option>';
        }
        echo '</select>';

        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $month, $year) ;

        echo '</p><table class="calendar">';
        echo '<tr>';
        echo '<th class="calendar_weekend">ROOM</th>';

        $day_num = 1;

        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            $currentDate = $year . '-' . $month . '-' . $day_num;

            $day_num_week = date("D", strtotime($currentDate));

            if($day_num < 10)
                $day_num = '0' . $day_num;

            if($day_num_week == "Sat" or $day_num_week == "Sun")
                echo '<th class="calendar_weekend" style="text-align:center;">' . (int)$day_num . '</th>';
            else
                echo '<th style="text-align:center;">' . (int)$day_num . '</th>';

            $day_num++;
        }

        echo "</tr>";

        $day_num = 1;

        foreach($rooms as $room)
        {
            echo '<tr>';
            echo '<td class="calendar_weekend">' . $room->title . '<br/><i>' . $room->roomType->description . '</i></td>';

            while ( $day_num <= $days_in_month )
            {
                $currentDate = $year . '-' . $month . '-' . $day_num;

                $day_num_week = date("D", strtotime($currentDate));

                if($day_num_week == "Sat" or $day_num_week == "Sun")
                    echo '<td class="calendar_weekend">';
                else
                    echo '<td style="text-align:center;">';

                echo meteCamas($room, ($year . '-' . $month . '-' . $day_num) );

                echo '</td>';

                $day_num++;
            }

            echo '</tr>';

            $day_num = 1;
        }

        echo "</table>";

        echo 'Camas vendidas: '. $camasVendidas;
    }
    else
        echo 'You need to insert a room first !';
}
?></p>
