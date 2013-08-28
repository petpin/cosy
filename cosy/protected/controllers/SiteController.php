<?php

class SiteController extends Controller
{
	private $months = array("(Select a month)","January","February","March","April","May","June","July","August","September","October","November","December");
	private $colors = array('primary', 'info', 'warning', 'danger', 'inverse');
	
	private function rand_colorCode()
	{
		return $cores[mt_rand(0,4)];
	}

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('excelView','roomView'),
                'expression'=>'!$user->isGuest',
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
		$this->redirect(array('excelView'));
    	
        //$this->render('index');
    }

    public function actionExcelView()
    {
    	/* Get Rooms */
    	$rooms = Room::model()->findAll();
    	$years = array();
    	$idRoom = 0;
    	
		if( isset($_GET["room"]) ) $idRoom = $_GET["room"];
    	
    	//This gets today's date
        $date = time();
        $currentMonth = date('m', $date);
        $currentYear = date('Y', $date);

		if(isset($_GET["month"]))
			$selectedMonth = $_GET["month"];
        else
        	$selectedMonth = (int)($currentMonth);
        
        if(isset($_GET["month"]))
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
        	'months'=>$this->months,
        	'years'=>$years,
        	'previousMonth'=>$previousMonth,
        	'nextMonth'=>$nextMonth,
        	'previousYear'=>$previousYear,
        	'nextYear'=>$nextYear,
        	'colors'=>$this->colors,
        ));
    }

    public function actionRoomView()
    {
    	/* Get Rooms */
    	$rooms = Room::model()->findAll();
    	$years = array();
    	$idRoom = $rooms[0]->id;
    	
		if( isset($_GET["room"]) && $_GET["room"] != 0 ) $idRoom = $_GET["room"];
    	
    	/* Get Specific Room */
        $criteria = new CDbCriteria;
        $criteria->condition='id=:id';
        $criteria->params=array(':id'=>$idRoom);

        $specificRoom = Room::model()->find($criteria);
    	
    	//This gets today's date
        $date = time();
        $currentMonth = date('m', $date);
        $currentYear = date('Y', $date);

		if(isset($_GET["month"]))
			$selectedMonth = $_GET["month"];
        else
        	$selectedMonth = (int)($currentMonth);
        
        if(isset($_GET["month"]))
			$selectedYear = $_GET["year"];
        else
        	$selectedYear = $currentYear;
        	
        for ($i_year = -2; $i_year <= 5; $i_year++)
        {
        	$tempYear = $currentYear + $i_year;
        	$years[$tempYear] = $tempYear;
        }
        
        $roomList = CHtml::listData($rooms, 'id', 'title');
    	
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
        	'months'=>$this->months,
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
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
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