<?php $this->pageTitle=Yii::app()->name; 

if( !isset($_GET["room"]) ) $idRoom = 4; else $idRoom = $_GET["room"];

?>

<p><?php Yii::app()->clientScript->registerCoreScript('jquery'); 

GLOBAL $camasVendidas;

if(!Yii::app()->user->isGuest)
{
	echo '<p> Bookings </p>';

	/* Get Rooms */
	$rooms = Room::model()->findAll();
	
	if(count($rooms) > 0)
	{
		$camasVendidas = 0;
		
		$ourscript = 'function redirect() {
				parent.location = \'index.php?r=site/index&room=\' + $(\'#room\').val() + \'&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
			}';
		
		Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);
		
		function meteCamas3($room, $day)
		{
			$app = 'cosy';
			$toReturn = '';
			//$toReturn .= '<td class="week_days_letter">';
		
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
					$criteria->condition='id=:id'; $criteria->params=array(':id'=>$bookingDay->id_booking);
					$booking = Booking::model()->find($criteria);
					
					$criteria->condition='id_booking=:id_booking'; $criteria->params=array(':id_booking'=>$bookingDay->id_booking);
					$bookingGuest = BookingGuest::model()->find($criteria);
					
					if($bookingDay->id_room == $room->id)
					{
						for($i = 0; $i < $bookingDay->bed_num; $i++)
						{
							$lableDiv[] = Guest::model()->findByPk($bookingGuest->id_guest)->name . ' (' . BookingState::model()->findByPk($booking->id_state)->description . ')';
							$url[] = 'http://www.nelsonjvf.com/yii/' . $app . '/index.php?r=booking/view&id=' . $booking->id;
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
				$toReturn .= '<a title="Free Spot" href="http://www.nelsonjvf.com/yii/' . $app . '/index.php?r=booking/create&room=' . $room->id . '&start_date=' . $day . '"><div class="icon_calendar_mini icon_calendar_light_green"></div></a>';
			}
			
			unset($lableDiv);
		
			//$toReturn .= '</td>';
		
			return $toReturn;
		}
		
		/* Get Rooms */
		$criteria = new CDbCriteria;
		$criteria->condition='id=:id';
		$criteria->params=array(':id'=>$idRoom);
		
		$specificRoom = Room::model()->find($criteria);
		
		unset($days);
		$week_number = $semana;
		
		//This gets today's date
		$date = time() ;
		
		$day = date('d', $date);
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
		
		$months = array(array("01","January"), 
						array("02","February"), 
						array("03","March"), 
						array("04","April"), 
						array("05","May"), 
						array("06","June"), 
						array("07","July"), 
						array("08","August"), 
						array("09","September"), 
						array("10","October"), 
						array("11","Novemeber"), 
						array("12","December"),);
						
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
		//This gets us the month name
		$title = date('F', $first_day) ;
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
		echo '<table id="calendar" class="calendar">';
		echo '<tr>';
		echo '<th class="week_days_letter">Mon</th>';
		echo '<th class="week_days_letter">Tue</th>';
		echo '<th class="week_days_letter">Wed</th>';
		echo '<th class="week_days_letter">Thu</th>';
		echo '<th class="week_days_letter">Fri</th>';
		echo '<th class="week_days_letter">Sat</th>';
		echo '<th class="week_days_letter">Sun</th>';
		echo '</tr>';
		//This counts the days in the week, up to 7
		$day_count = 1;
		
		echo "<tr>";
		
		//first we take care of those blank days
		while ( $blank > 0 )
		{
			echo '<td class="week_days_letter"></td>';
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
			
			echo '<td class="week_days_letter">' . $day_num . '<br />';
			//echo '<table class="calendar">';
			//echo '<tr>';
			echo meteCamas3($specificRoom, ($year . '-' . $month . '-' . $day_num) );
			//echo '</tr>';
			//echo '</table>';
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
		
		echo "</tr></table>";
		
		echo 'Sold beds: '. $camasVendidas;
	}
	else
		echo 'You need to insert a room first !';
}
?></p>
