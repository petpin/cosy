<?php

class SiteController extends Controller
{
	private function getMonthsArray(){
		return array('('.Yii::t('contentForm','SELECT_A_MONTH').')',Yii::t('contentForm','JANUARY'),Yii::t('contentForm','FEBRUARY'),Yii::t('contentForm','MARCH'),Yii::t('contentForm','APRIL'),Yii::t('contentForm','MAY'),Yii::t('contentForm','JUNE'),Yii::t('contentForm','JULY'),Yii::t('contentForm','AUGUST'),Yii::t('contentForm','SEPTEMBER'),Yii::t('contentForm','OCTOBER'),Yii::t('contentForm','NOVEMBER'),Yii::t('contentForm','DECEMBER'));
	}
//	private $months = array("(Select a month)","January","February","March","April","May","June","July","August","September","October","November","December");
	private $colors = array('primary', /*'info',*/ 'warning', 'danger', 'inverse'/*, 'gray'*/);
	
	private function rand_colorCode()
	{
		return $cores[mt_rand(0,4)];
	}

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('excelView','roomView','weeklyView'),
                'expression'=>'$user->isGuest',
            ),
            array('allow',
                'actions'=>array('site','booking'),
                'expression'=>'$user->isAdmin()',
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }
	
    /**
        * Declares class-based actions.
        */
    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
   		 ),
            'page'=>array(
                'class'=>'CViewAction',
        ),
        );
    }

    public function actionIndex()
    {
    	if(Yii::app()->request->cookies['dynamicTheme']->value == 'bootstrap-mobile')
			$this->redirect(array('roomView'));
    	else
    		$this->redirect(array('excelView'));
    		
        //$this->render('index');
    }

    public function actionExcelView()
    {
    	/* Get Rooms */
    	$rooms = Room::model()->findAll();
    	$years = array();
    	$idRoom = Yii::app()->request->getQuery('room');
    	
    	//This gets today's date
        $date = time();
        $currentMonth = date('m', $date);
        $currentYear = date('Y', $date);

		if(isset($_GET["month"]))
			$selectedMonth = $_GET["month"];
        else
        	$selectedMonth = (int)($currentMonth);
        
        if(isset($_GET["year"]))
			$selectedYear = $_GET["year"];
        else
        	$selectedYear = (int)($currentYear);
        	
        for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $currentYear + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
    	
    	$previousMonth = $selectedMonth - 1;
    	$nextMonth = $selectedMonth + 1;
    	$previousYear = $selectedYear;
    	$nextYear = $selectedYear;
    	
    	if($selectedMonth == 1)
    	{
    		$previousMonth = 12;
    		$previousYear = $selectedYear - 1;
    	}
    	else if($selectedMonth == 12)
    	{
    		$nextMonth = 1;
    		$nextYear = $selectedYear + 1;
    	}
    	
        $this->render('excelView', array(
        	'rooms'=>$rooms,
        	'idRoom'=>$idRoom,
        	'month'=>$selectedMonth,
        	'year'=>$selectedYear,
        	'months'=>$this->getMonthsArray(),
        	'years'=>$years,
        	'previousMonth'=>$previousMonth,
        	'nextMonth'=>$nextMonth,
        	'previousYear'=>$previousYear,
        	'nextYear'=>$nextYear,
        	'colors'=>$this->colors,
        ));
    }

	public function actionWeeklyView()
    {
    	/* Get Rooms */
    	$rooms = Room::model()->findAll();
    	$years = array();
    	$idRoom = Yii::app()->request->getQuery('room');
    	$selectedMonth = Yii::app()->request->getQuery('month');
		$selectedYear = Yii::app()->request->getQuery('year');
		$selectedWeek = Yii::app()->request->getQuery('week');
    	
    	//This gets today's date
        $date = time();
        $currentYear = date('Y', $date);
        $currentWeek = date('W', $date);
        $currentMonth = date('m', $date);

		if($selectedYear == null)
        	$selectedYear = (int)($currentYear);

		if($selectedWeek == null)
			$selectedWeek = (int)($currentWeek);
		else
			$currentMonth = date('m', strtotime($selectedYear."W".$selectedWeek.'1'));

		if($selectedMonth == null)
        	$selectedMonth = (int)($currentMonth);
        	
        for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $currentYear + $i_year;
        	
        	$years[$tempYear] = $tempYear;
        }
        
        $yearWeakNumber=date("W",mktime(0,0,0,12,28,$selectedYear));
        for($i_week = 1; $i_week <= $yearWeakNumber; $i_week++)
        {
        	//set the 1..9 to 01..09
        	if($i_week<10)
        		$i_week_aux="0".$i_week;
        	else
        		$i_week_aux=$i_week;
        	//define the first day and the last day of current week
        	$firstDayOfWeek = date('Y-m-d', strtotime($selectedYear."W".$i_week_aux.'1'));
        	$lastDayOfWeek = date('Y-m-d', strtotime($selectedYear."W".$i_week_aux.'7'));
        	$weeks[$i_week] = $i_week_aux . '   (' . $firstDayOfWeek . '   ' . Yii::t('contentForm','TO') . ': ' . $lastDayOfWeek . ')';
        }
    	
    	$previousMonth = $selectedMonth - 1;
    	$nextMonth = $selectedMonth + 1;
    	$previousYear = $selectedYear;
    	$nextYear = $selectedYear;
    	$previousWeek = $selectedWeek - 1;
    	$nextWeek = $selectedWeek + 1;
    	
    	if($selectedMonth == 1)
    	{
    		$previousMonth = 12;
    		$previousYear = $selectedYear - 1;
    	}
    	else if($selectedMonth == 12)
    	{
    		$nextMonth = 1;
    		$nextYear = $selectedYear + 1;
    	}
    	
    	if($selectedWeek<10)
    		$i_week_aux="0".$selectedWeek;
    	else
    		$i_week_aux=$selectedWeek;
    	
    	$firstDaySelectedWeek = date('d', strtotime($selectedYear."W".$i_week_aux.'1'));
    	$monthSelectedWeek = date('m', strtotime($selectedYear."W".$i_week_aux.'1'));
    	$yearSelectedWeek = date('y', strtotime($selectedYear."W".$i_week_aux.'1'));
    	
    	$lastDaySelectedWeek = date('d', strtotime($selectedYear."W".$i_week_aux.'7'));
    	
        $this->render('weeklyView', array(
        	'rooms'=>$rooms,
        	'idRoom'=>$idRoom,
        	'colors'=>$this->colors,
        	'months'=>$this->getMonthsArray(),
        	'years'=>$years,
        	'weeks'=>$weeks,
        	'month'=>$selectedMonth,
        	'nextMonth'=>$nextMonth,
        	'previousMonth'=>$previousMonth,
        	'year'=>$selectedYear,
        	'nextYear'=>$nextYear,
        	'previousYear'=>$previousYear,
        	'week'=>$selectedWeek,
        	'nextWeek'=>$nextWeek,
        	'previousWeek'=>$previousWeek,
        	'firstDaySelectedWeek'=> $firstDaySelectedWeek,
        	'monthSelectedWeek'=>$monthSelectedWeek,
        	'yearSelectedWeek'=>$yearSelectedWeek,
        	'lastDaySelectedWeek' => $lastDaySelectedWeek,
        ));
    }

    public function actionRoomView()
    {
    	$years = array();
    	
    	/* Get Rooms */
    	$rooms = Room::model()->findAll();
    	$roomList = CHtml::listData($rooms, 'id', 'title');
    	$idRoom = Yii::app()->request->getQuery('room');
    	
    	if($idRoom == null)
    		$idRoom = $rooms[0]->id;
    	
    	$selectedMonth = Yii::app()->request->getQuery('month');
		$selectedYear = Yii::app()->request->getQuery('year');
    	
    	//This gets today's date
        $date = time();
        $currentMonth = date('m', $date);
        $currentYear = date('Y', $date);

		if($selectedMonth == null)
        	$selectedMonth = (int)($currentMonth);
        
        if($selectedYear == null)
        	$selectedYear = (int)($currentYear);
    	
    	/* Get Specific Room */
        $criteria = new CDbCriteria;
        $criteria->condition='id=:id';
        $criteria->params=array(':id'=>$idRoom);

        $specificRoom = Room::model()->find($criteria);
        	
        for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $currentYear + $i_year;
        	$years[$tempYear] = $tempYear;
        }
    	
    	$previousMonth = $selectedMonth - 1;
    	$nextMonth = $selectedMonth + 1;
    	$previousYear = $selectedYear;
    	$nextYear = $selectedYear;
    	
    	if($selectedMonth == 1)
    	{
    		$previousMonth = 12;
    		$previousYear = $selectedYear - 1;
    	}
    	else if($selectedMonth == 12)
    	{
    		$nextMonth = 1;
    		$nextYear = $selectedYear + 1;
    	}
    	
        $this->render('roomView', array(
        	'idRoom'=>$idRoom,
        	'specificRoom'=>$specificRoom,
        	'rooms'=>$roomList,
        	'month'=>$selectedMonth,
        	'year'=>$selectedYear,
        	'months'=>$this->getMonthsArray(),
        	'years'=>$years,
        	'previousMonth'=>$previousMonth,
        	'nextMonth'=>$nextMonth,
        	'previousYear'=>$previousYear,
        	'nextYear'=>$nextYear,
        	'colors'=>$this->colors,
        ));
    }

    public function actionReport()
    {
        $this->render('report');
    }

    /**
    * This is the action to handle external exceptions.
    */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionContact()
    {
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact',Yii::t('contentForm','INFO_CONTACT'));
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
    }

    public function actionLogin()
    {
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
				echo CActiveForm::validate($model);
				Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
    }

    public function actionLogout()
    {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
    }
}