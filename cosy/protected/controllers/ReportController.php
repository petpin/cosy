<?php

class ReportController extends Controller
{
	private $months = array("(Select a month)","January","February","March","April","May","June","July","August","September","October","November","December");
	
    public $layout='//layouts/column1';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('month','year','pdfReport','supplierBooking','supplierClients','supplierMoney','supplierRate','dailyReport','checkInForm','guestReport'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
        

	public function getBedOccupancyTaxYear($criteria)
	{
		$total = 0;
		$total_camas_quartos = 0;
		
		$rooms = Room::model()->findAll();
		
		foreach ($rooms as $room)
		{
			$total_camas_quartos += $room->bed_num;
		}
		
		if($this->getTotalCamasVendidas($criteria) > 0) 
			$total = round( ( ( $this->getTotalCamasVendidas($criteria) * 100 ) / ( $total_camas_quartos * 365 ) ), 2);
		else
			$total =0;
		
		return $total;		
	}
	
	public function getBedOccupancyTaxMonth($criteria, $monthToSearch, $yearToSearch)
	{
		$total = 0;
		$total_camas_quartos = 0;
		$numeroDiasMesActual = (cal_days_in_month(0, $monthToSearch, $yearToSearch));
		
		$rooms = Room::model()->findAll();
		
		foreach ($rooms as $room)
		{
			$total_camas_quartos += $room->bed_num;
		}
		
		if($this->getTotalCamasVendidas($criteria) > 0) 
			$total = round( ( ( $this->getTotalCamasVendidas($criteria) * 100 ) / ( $total_camas_quartos * $numeroDiasMesActual ) ), 2);
		else
			$total =0;
		
		return $total;		
	}
	
	public function getAverageBedRate($criteria)
	{
		$total = 0;
		$totalCamasVendidas=$this->getTotalCamasVendidas($criteria);
		
		if($totalCamasVendidas > 0) 
			$total = round( (  $this->getTotalFaturado($criteria) / $totalCamasVendidas ), 2);
		else
			$total =0;
		
		return $total;		
	}
	
	public function getGuestByBookingDay($id_booking)
	{
		return Guest::model()->findByPk(BookingGuest::model()->findByPk($id_booking)->id_guest)->name;
	}
	
	public function getRoomByBookingDay($id_room)
	{
		return Room::model()->findByPk($id_room)->title;
	}
	
	public function getTotalCamasVendidas($criteria)
	{
		$total_camas_vendidas = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach ($bookingDays as $bookingDay)
		{
			$total_camas_vendidas += $bookingDay->bed_num;
		}
		
		return $total_camas_vendidas;
	}
	
	public function getTaxaOcupacao($criteria)
	{
		$total_camas_vendidas = 0;
		$total_camas_quartos = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach ($bookingDays as $bookingDay)
		{
			$total_camas_vendidas += $bookingDay->bed_num;
		}
		
		$rooms = Room::model()->findAll();
		
		foreach ($rooms as $room)
		{
			$total_camas_quartos += $room->bed_num;
		} 	
			//* (count(cal_days_in_month(0, $monthToSearch, $yearToSearch)))
		
		if($total_camas_vendidas > 0)
			return round( ( ( $total_camas_vendidas ) / ( $total_camas_quartos )) * 100, 2);
		else
			return '0';
	}
	
	public function getTotalFaturado($criteria)
	{
		$total_faturado = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach ($bookingDays as $bookingDay)
		{
			$total_faturado += $bookingDay->price;
		}
		
		return round($total_faturado, 2);
	}
	
	public function getTotalReservas($criteria)
	{
		$numero_reservas = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		return count($bookingDays);
	}

	public function getBookingById($id)
	{	
		$booking = Booking::model()->findByPk($id);

		return $booking;
	}	
	
	public function getHospedesEntrada($criteria)
	{	
		$bookings = BookingDays::model()->findAll($criteria);

		return $bookings;
	}

	public function getGuestByBookingID($criteria)
	{	
		$bookings = BookingGuest::model()->findAll($criteria);

		return $bookings;
	}
	
	public function getTotalFaturadoSemRate($criteria)
	{
		$total_faturado_sem_rate = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach ($bookingDays as $bookingDay)
		{
			$total_faturado_sem_rate += ($bookingDay->price - ($bookingDay->price * ($bookingDay->supplier_rate/100)));
		}
		
		return round($total_faturado_sem_rate, 2);
	}
	
	public function getTotalRatePago($criteria)
	{
		$total_pago_em_rate = 0;
		
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach ($bookingDays as $bookingDay)
		{
			$total_pago_em_rate +=  ($bookingDay->price * ($bookingDay->supplier_rate/100));
		}
		
		return round($total_pago_em_rate, 2);
	}

	public function actionMonth()
	{
		//This gets today's date
		$date = time() ;

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	
	    if(!isset($_GET["year"]))
	        $yearToSearch = $year;
	    else
	        $yearToSearch = $_GET["year"];
	
	    if(!isset($_GET["month"]))
	        $monthToSearch = $month;
	    else
	       	$monthToSearch = $_GET["month"];
   
   		/*
	     * 	Francisco Fernandes 2012 - Codigo responsavel pela população da combo de anos, o codigo vai preenchendo a combo consuante o ano do presente
	     *	Nelson Ferreira 2013 - Codigo adaptado e inserido no Controller
	     */
   		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	$years[$tempYear] = $tempYear;
        }
        
        /*
         *	Codigo responsável por sacar a informacao - Sold Beds | Value | Value without rates | Average Bed Rate | Bed Occupancy Tax
         */
        if($yearToSearch==$year && $monthToSearch==$month)
        {
            $criteria = new CDbCriteria;
            $criteria->condition='day>=:day_start AND day<:day_end';
            $criteria->params=array(':day_start'=> $yearToSearch . '-' . $monthToSearch . '-01',
                                    ':day_end'=> $yearToSearch . '-' . ($monthToSearch) . '-'.$day.'');
        }
        else
        {
            $criteria = new CDbCriteria;
            $criteria->condition='day>=:day_start AND day<:day_end';
            $criteria->params=array(':day_start'=> $yearToSearch . '-' . $monthToSearch . '-01',
                                    ':day_end'=> $yearToSearch . '-' . ($monthToSearch+1) . '-01');
        }
        
        $totalCamasVendidas = $this->getTotalCamasVendidas($criteria);
        $totalFaturado = $this->getTotalFaturado($criteria);
        $totalFaturadoSemRate = $this->getTotalFaturadoSemRate($criteria);
        $averageBedRate = $this->getAverageBedRate($criteria);
        $bedOccupancyTaxMonth = $this->getBedOccupancyTaxMonth($criteria, $monthToSearch, $yearToSearch);
        
        $graphData = "";
        
        //We then determine how many days are in the current month
	    $days_in_month = cal_days_in_month(0, $monthToSearch, $yearToSearch);
	    $day_num = 1;
	
	    //count up the days, untill we've done all of them in the month
	    while ( $day_num <= $days_in_month )
	    {		
            $criteria = new CDbCriteria;
            $criteria->condition='day = :day';
            $criteria->params=array(':day'=> $yearToSearch . '-' . $monthToSearch . '-' .$day_num);

            //print_r($criteria);
            $graphData .= "['$day_num', ";
            $graphData .= $this->getTotalCamasVendidas($criteria) . ", " . $this->getTaxaOcupacao($criteria); //echo ", " . echo $this->getTotalFaturado($criteria);
            $graphData .= "], ";
            
            $day_num++;
	    }
   
		$this->render('month', array(
			'months'=>$this->months,
			'month'=>(int)$monthToSearch,
			'years'=>$years,
			'year'=>$yearToSearch,
			'totalCamasVendidas'=>$totalCamasVendidas,
			'totalFaturado'=>$totalFaturado,
			'totalFaturadoSemRate'=>$totalFaturadoSemRate,
			'averageBedRate'=>$averageBedRate,
			'bedOccupancyTaxMonth'=>$bedOccupancyTaxMonth,
			'graphData'=>$graphData,
		));
	}
	
	public function actionYear()
	{
		//This gets today's date
		$date = time() ;

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	
	    if(!isset($_GET["year"]))
	        $yearForQuery = $year;
	    else
	        $yearForQuery = $_GET["year"];
	       
		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	$years[$tempYear] = $tempYear;
        }
	
		if($yearForQuery==$year)
		{
			$criteria = new CDbCriteria;
			$criteria->condition='day>:day_start AND day<:day_end';
			//$criteria->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery . '-' . $thisMonth . '-' .$day);
			$criteria->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery . '-12-31');
		}
		else
		{
			$criteria = new CDbCriteria;
			$criteria->condition='day>:day_start AND day<:day_end';
			$criteria->params=array(':day_start'=> $yearForQuery . '-01-01', ':day_end'=> $yearForQuery+1 . '-01-01');
		}
		
		$totalCamasVendidas = $this->getTotalCamasVendidas($criteria);
        $totalFaturado = $this->getTotalFaturado($criteria);
        $totalFaturadoSemRate = $this->getTotalFaturadoSemRate($criteria);
        $averageBedRate = $this->getAverageBedRate($criteria);
        $bedOccupancyTaxYear = $this->getBedOccupancyTaxYear($criteria);
        
        $graphData = "";
        
        $functionMonths = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);
	  
		foreach($functionMonths as $month)
		{
			$currentMonth = (int)$month[0];
			$nextMonth = (int)$month[0] + 1;
		
			$criteria = new CDbCriteria;
			$criteria->condition='day>=:day_start AND day<:day_end';
			$criteria->params=array(':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
									':day_end'=> $yearForQuery . '-' . $nextMonth . '-01');
		
			//print_r($criteria);
			$graphData .= "['" . $month[1] . "', ";
			$graphData .= $this->getTotalCamasVendidas($criteria);
			//$graphData .= ", " . $this->getTaxaOcupacao($criteria);
			$graphData .= "], ";
		}
        
		
		$this->render('year', array(
			'years'=>$years,
			'year'=>$yearForQuery,
			'yearForQuery'=>$yearForQuery,
			'totalCamasVendidas'=>$totalCamasVendidas,
			'totalFaturado'=>$totalFaturado,
			'totalFaturadoSemRate'=>$totalFaturadoSemRate,
			'averageBedRate'=>$averageBedRate,
			'bedOccupancyTaxYear'=>$bedOccupancyTaxYear,
			'graphData'=>$graphData,
		));
	}
	
	public function actionSupplierBooking()
	{
		$criteria = new CDbCriteria;
		
		//This gets today's date
		$date = time();

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	
	    if(!isset($_GET["year"]))
	        $yearForQuery = $year;
	    else
	        $yearForQuery = $_GET["year"];
	       
		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
        
        $suppliers = Supplier::model()->findAll();
		$supplierName = array();
		$totalReservas = array();
	
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery == $year)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-' . $month . '-' . $day,
					':supplier'=> $supplier->id
				);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-31',
					':supplier'=> $supplier->id
				);
			}
			
			//var_dump($criteria);
			
			$supplierNames[] = $supplier->name;
			$totalReservas[] = $this->getTotalReservas($criteria);
		}
		
		/*
		 *	2013 @ Line Graph Data
		 */
		$lineGraphData = "";
		$months = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);

		foreach($months as $monthItem) //Meses Passados do Ano Corrente
		{
			$currentMonth = (int)$monthItem[0];
			$nextMonth = (int)$monthItem[0] + 1;
			
			$lineGraphData .= "['$monthItem[1]'";
			foreach($suppliers as $supplier)
			{				
				if($currentMonth > (int)$month && $yearForQuery == $year)
				{
					$lineGraphData .= ', 0';
				}
				else if($currentMonth == (int)$month)
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-' . $day,
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalReservas($criteria);
				}
				else
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-01',
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalReservas($criteria);
				}
			}
			$lineGraphData .= "], ";
		}
		
		/*
		 *	2013 @ Pie Graph Data
		 */
		$pieGraphData = "['Supplier', 'Total Bookings'],";
		
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery < $year || $yearForQuery > $year)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-01',
					':supplier'=> $supplier->id);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-'. $month . '-' .$day,
					':supplier'=> $supplier->id);
			}
			
			$pieGraphData .= "['$supplier->name', " . $this->getTotalReservas($criteria) . "],";				
		}
		
		$this->render('supplierBooking', array(
			'years'=>$years,
			'year'=>$yearForQuery,
			'suppliers'=>$suppliers,
			'supplierNames'=>$supplierNames,
			'totalReservas'=>$totalReservas,
			'lineGraphData'=>$lineGraphData,
			'pieGraphData'=>$pieGraphData,
		));
	}
	
	public function actionSupplierClients()
	{
		$criteria = new CDbCriteria;
		
		//This gets today's date
		$date = time();

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	    
	    $currentYear = $year;
		$currentMonth = $month;
		$currentDay = $day;
	
	    if(!isset($_GET["year"]))
	        $yearForQuery = $year;
	    else
	        $yearForQuery = $_GET["year"];
	       
		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
        
        $suppliers = Supplier::model()->findAll();
		
		$supplierName = array();
		$totalReservas = array();
	
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery == $currentYear)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-' . $currentMonth . '-' . $currentDay,
					':supplier'=> $supplier->id
				);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-31',
					':supplier'=> $supplier->id
				);
			}
			
			$supplierNames[] = $supplier->name;
			$totalReservas[] = $this->getTotalReservas($criteria);
		}
		
		/*
		 *	2013 @ Line Graph Data
		 */
		$lineGraphData = "";
		$months = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);

		foreach($months as $monthItem) //Meses Passados do Ano Corrente
		{
			$currentMonth = (int)$monthItem[0];
			$nextMonth = (int)$monthItem[0] + 1;
			
			$lineGraphData .= "['$monthItem[1]'";				
			foreach($suppliers as $supplier)
			{				
				if($currentMonth > (int)$month && $yearForQuery == $year)
				{
					$lineGraphData .= ', 0';
				}
				else if($currentMonth == (int)$month)
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-' . $day,
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalCamasVendidas($criteria);
				}
				else
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-01',
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalCamasVendidas($criteria);
				}
			}
			$lineGraphData .= "], ";
		}
		
		/*
		 *	2013 @ Pie Graph Data
		 */
		$pieGraphData = "['Supplier', 'Total Bookings'],";
		
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery < $year || $yearForQuery > $year)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-01',
					':supplier'=> $supplier->id);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-'. $month . '-' .$day,
					':supplier'=> $supplier->id);
			}
			
			$pieGraphData .= "['$supplier->name', " . $this->getTotalCamasVendidas($criteria) . "],";				
		}
		
		
		$this->render('supplierClients', array(
			'year'=>$yearForQuery,
			'years'=>$years,
			'suppliers'=>$suppliers,
			'supplierNames'=>$supplierNames,
			'totalReservas'=>$totalReservas,
			'lineGraphData'=>$lineGraphData,
			'pieGraphData'=>$pieGraphData,
		));
	}
	
	public function actionSupplierMoney()
	{
		$criteria = new CDbCriteria;
		
		//This gets today's date
		$date = time();

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	    
	    $currentYear = $year;
		$currentMonth = $month;
		$currentDay = $day;
	
	    if(!isset($_GET["year"]))
	        $yearForQuery = $year;
	    else
	        $yearForQuery = $_GET["year"];
	       
		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
        
        $suppliers = Supplier::model()->findAll();
		
		$supplierName = array();
		$totalReservas = array();
	
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery == $currentYear)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-' . $currentMonth . '-' . $currentDay,
					':supplier'=> $supplier->id
				);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-31',
					':supplier'=> $supplier->id
				);
			}
			
			$supplierNames[] = $supplier->name;
			$totalReservas[] = $this->getTotalFaturadoSemRate($criteria);
		}
		
		/*
		 *	2013 @ Line Graph Data
		 */
		$lineGraphData = "";
		$months = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);

		foreach($months as $monthItem) //Meses Passados do Ano Corrente
		{
			$currentMonth = (int)$monthItem[0];
			$nextMonth = (int)$monthItem[0] + 1;
			
			$lineGraphData .= "['$monthItem[1]'";				
			foreach($suppliers as $supplier)
			{				
				if($currentMonth > (int)$month && $yearForQuery == $year)
				{
					$lineGraphData .= ', 0';
				}
				else if($currentMonth == (int)$month)
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-' . $day,
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalFaturadoSemRate($criteria);
				}
				else
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-01',
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalFaturadoSemRate($criteria);
				}
			}
			$lineGraphData .= "], ";
		}
		
		/*
		 *	2013 @ Pie Graph Data
		 */
		$pieGraphData = "['Supplier', 'Total Bookings'],";
		
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery < $year || $yearForQuery > $year)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-01',
					':supplier'=> $supplier->id);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-'. $month . '-' .$day,
					':supplier'=> $supplier->id);
			}
			
			$pieGraphData .= "['$supplier->name', " . $this->getTotalFaturadoSemRate($criteria) . "],";				
		}
        
		$this->render('supplierMoney', array(
			'year'=>$yearForQuery,
			'years'=>$years,
			'suppliers'=>$suppliers,
			'supplierNames'=>$supplierNames,
			'totalReservas'=>$totalReservas,
			'lineGraphData'=>$lineGraphData,
			'pieGraphData'=>$pieGraphData,
		));
	}
	
	public function actionSupplierRate()
	{
		$criteria = new CDbCriteria;
		
		//This gets today's date
		$date = time();

	    $day = date('d', $date);
	    $month = date('m', $date);
	    $year = date('Y', $date);
	    
	    $currentYear = $year;
		$currentMonth = $month;
		$currentDay = $day;
	
	    if(!isset($_GET["year"]))
	        $yearForQuery = $year;
	    else
	        $yearForQuery = $_GET["year"];
	       
		for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $year + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
        
        $suppliers = Supplier::model()->findAll();
		
		$supplierName = array();
		$totalReservas = array();
	
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery == $currentYear)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-' . $currentMonth . '-' . $currentDay,
					':supplier'=> $supplier->id
				);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-31',
					':supplier'=> $supplier->id
				);
			}
			
			$supplierNames[] = $supplier->name;
			$totalReservas[] = $this->getTotalRatePago($criteria);
		}
		
		/*
		 *	2013 @ Line Graph Data
		 */
		$lineGraphData = "";
		$months = array(array("01","Jan"), array("02","Feb"), array("03","Mar"), 
						array("04","Apr"), array("05","May"), array("06","Jun"), 
						array("07","Jul"), array("08","Aug"), array("09","Sep"), 
						array("10","Oct"), array("11","Nov"), array("12","Dec"),);

		foreach($months as $monthItem) //Meses Passados do Ano Corrente
		{
			$currentMonth = (int)$monthItem[0];
			$nextMonth = (int)$monthItem[0] + 1;
			
			$lineGraphData .= "['$monthItem[1]'";				
			foreach($suppliers as $supplier)
			{				
				if($currentMonth > (int)$month && $yearForQuery == $year)
				{
					$lineGraphData .= ', 0';
				}
				else if($currentMonth == (int)$month)
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-' . $day,
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalRatePago($criteria);
				}
				else
				{
					$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
					$criteria->params=array(
						':day_start'=> $yearForQuery . '-' . $currentMonth . '-01',
						':day_end'=> $yearForQuery . '-' . $nextMonth . '-01',
						':supplier'=> $supplier->id
					);
					
					$lineGraphData .= ', ' . $this->getTotalRatePago($criteria);
				}
			}
			$lineGraphData .= "], ";
		}
		
		/*
		 *	2013 @ Pie Graph Data
		 */
		$pieGraphData = "['Supplier', 'Total Bookings'],";
		
		foreach($suppliers as $supplier)
		{
			$criteria->condition='day>=:day_start AND day<:day_end AND id_supplier =:supplier';
			
			if($yearForQuery < $year || $yearForQuery > $year)
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-12-01',
					':supplier'=> $supplier->id);
			}
			else
			{
				$criteria->params=array(
					':day_start'=> $yearForQuery . '-01-01',
					':day_end'=> $yearForQuery . '-'. $month . '-' .$day,
					':supplier'=> $supplier->id);
			}
			
			$pieGraphData .= "['$supplier->name', " . $this->getTotalRatePago($criteria) . "],";				
		}
        
		$this->render('supplierRate', array(
			'year'=>$yearForQuery,
			'years'=>$years,
			'suppliers'=>$suppliers,
			'supplierNames'=>$supplierNames,
			'totalReservas'=>$totalReservas,
			'lineGraphData'=>$lineGraphData,
			'pieGraphData'=>$pieGraphData,
		));
	}
	
	public function actionDailyReportCheckOut($today)
	{
		$dataCheckOut = array();
		$today = date("Y-m-d", strtotime($today));
		$yesterday = date("Y-m-d", strtotime($today . ' - 1 day'));
		
		$criteria = new CDbCriteria;
		$criteria->condition='day=:day';
		$criteria->params=array(':day'=> $yesterday);
		
		$bookingDays = $this->getHospedesEntrada($criteria);
		
		foreach($bookingDays as $bookingDay)
		{
			$criteria2 = new CDbCriteria;
			$criteria2->condition='day=:day AND id_booking =:id_booking';
			$criteria2->params=array(':day'=> $today, ':id_booking'=> $bookingDay->id_booking);
			
			$bookingDays = $this->getHospedesEntrada($criteria2);
			
			if(count($bookingDays)==0)
			{
				$bookingInfo = Booking::model()->findByPk($bookingDay->id_booking);
				$guest = $this->getGuestByBookingDay($bookingDay->id_booking);
				$room = $this->getRoomByBookingDay($bookingDay->id_room);
				
				$dataCheckOut[] = array(
					0=>$bookingDay->id_booking,
					1=>$guest,
					2=>$room,
					3=>$bookingDay->bed_num,
					4=>$bookingInfo->value,
					5=>$bookingDay->Booking->bookingState->id
				);
			}	
		}
		
		return $dataCheckOut;
	}
	
	public function actionDailyReportCheckIn($today)
	{
		$dataCheckIn = array();
		
		// Converte to table Booking date format
		$today = date("Y-m-d", strtotime($today));
		
		$criteria = new CDbCriteria;
		$criteria->condition='start_date=:start_day';
		$criteria->params=array(':start_day'=> $today);

		$bookings = Booking::model()->findAll($criteria);
		
		foreach($bookings as $booking)
		{
			$criteria2 = new CDbCriteria;
			$criteria2->condition='day=:start_day AND id_booking =:id_booking';
			$criteria2->params=array(':start_day'=> $today, ':id_booking'=> $booking->id);
			
			$booking_day = $this->getHospedesEntrada($criteria2);
			
			$guest = $this->getGuestByBookingDay($booking->id);
			$roomTitle = $this->getRoomByBookingDay($booking_day[0]->id_room); 
			
			$dataCheckIn[] = array(
				0=>$booking->id,
				1=>$guest,
				2=>$roomTitle,
				3=>$booking_day[0]->bed_num,
				4=>$booking->value,
				5=>$booking_day[0]->Booking->bookingState->id
			);
		}
		
		return $dataCheckIn;
	}
	
	public function actionDailyReport()
	{
		if(isset($_GET["day"]))
			$today = $_GET["day"];
		else
			$today = date('d-m-Y', time());
			
		$dataCheckIn = $this->actionDailyReportCheckIn($today);
		$dataCheckOut = $this->actionDailyReportCheckOut($today);
		
		//var_dump($dataCheckIn);
		
		$this->render('dailyReport', array(
			'today'=>$today,
			'dataCheckIn'=>$dataCheckIn,
			'dataCheckOut'=>$dataCheckOut,
		));
	}
	
	/*
	 *	Francisco - This operation returns all the guests how are at the hostel tonight
	 *	15-06-2013 - Retificada a lógica, retirada da View
	 */
	public function actionGuestReport()
	{
		if(isset($_GET["day"]))
			$today = $_GET["day"];
		else
			$today = date('d-m-Y', time());
			
		$dataCheckIn = $this->actionDayGuestReport($today);
		
		$this->render('guestReport', array(
			'today'=>$today,
			'dataCheckIn'=>$dataCheckIn,
		));
	}
	
	/*
	 *	15-06-2013 - Saca o clientes presentes no hostel na data @ $today
	 */
	public function actionDayGuestReport($today)
	{
		$dataCheckIn = array();
		
		// Converte to table BookingDays - date format
		$today = date("Y-m-d", strtotime($today));
		
		$criteria = new CDbCriteria;
		$criteria->condition='day=:day';
		$criteria->params=array(':day'=> $today);

		$bookings = BookingDays::model()->findAll($criteria);
		
		foreach($bookings as $booking)
		{
			$bookingA =  $this->getBookingById($booking->id_booking);
			$guest = $this->getGuestByBookingDay($booking->id_booking);
			$roomTitle = $this->getRoomByBookingDay($booking->id_room);
			$endDate = strtotime ( '+'.$bookingA->night_num.' day' , strtotime ( $bookingA->start_date ) );			
			
			$dataCheckIn[] = array(
				0=>$booking->id_booking,
				1=>$guest,
				2=>$roomTitle,
				3=>$booking->bed_num,
				4=>$bookingA->start_date,
				5=>date("Y-m-d", $endDate),
				6=>$bookingA->bookingState->description
			);
		}
		
		return $dataCheckIn;
	}
	
	public function actionCheckInForm()
	{
        $this->render('checkInForm',array());
	}
	
	public function actionPdfReport()
	{
        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');

        # Load a stylesheet
        //$stylesheet = file_get_contents('/home/content/89/6627889/html/yii/cosy/themes/pachu/css/main.css');
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');

        $mPDF1->WriteHTML($stylesheet, 1);

        //$mPDF1->WriteHTML(Yii::getPathOfAlias('application') . '/../themes/pachu/css/main.css');

        //$mPDF1->WriteHTML($this->renderPartial('dailyReport', array('dataCheckIn'=>$this->actionDailyReportCheckIn(), 'dataCheckOut'=>$this->actionDailyReportCheckOut()), true));
        $mPDF1->WriteHTML($this->renderPartial('year', array('pdfReport'=>true), true));

        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        $mPDF1->Output();

        /*
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
                $html2pdf->WriteHTML($content);

        $html2pdf->WriteHTML($this->renderPartial('dailyReport',array('dataCheckIn'=>$this->actionDailyReportCheckIn(), 'dataCheckOut'=>$this->actionDailyReportCheckOut()), true));
        //$html2pdf->Output();

        $html2pdf->Output('../../file.pdf', EYiiPdf::OUTPUT_TO_FILE);

        header('Content-Type: application/pdf');
        readfile('../../file.pdf');
        */
	}
}
