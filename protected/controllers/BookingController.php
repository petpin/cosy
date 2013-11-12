<?php

class BookingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		array('allow',
			'actions'=>array('index','view','updateBookingViewTab','viewDetails','viewGuest',
							'viewDays','viewSupplier', 'viewPackages', 'viewCreateBookingPackage', 
							'associateBookingPackage', 'deassociateBookingPackage', 'verifyRoomSpaceAvailability',
							'create','ajaxCreate','update','updateEditable','ajaxUpdate','pdfView','ajaxStateUpdate'),
			'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
		),
		array('allow',
				'actions'=>array('admin','delete'),
				'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
		),
		array('deny',
				'users'=>array('*'),
		),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$guestName = CHtml::encode($model->bookingGuest[0]->guest->name);
		
		$model->id_supplier = $model->bookingDays[0]->id_supplier;
		$model->id_room = $model->bookingDays[0]->id_room;
		
		$totalValueToPay = $model->getTotalValueByBookingId($model->id, $model->value);
		
		if($model->paid == '0') $paidValue = Yii::t('contentForm','NOT_PAID');
		else			$paidValue = Yii::t('contentForm','PAID');
		
		if(isset($_GET["ajax"]))
		{
			$this->renderPartial('view',array(
				'model'=>$model,
				'guestName'=>$guestName,
				'paidValue'=>$paidValue,
				'totalValueToPay'=>$totalValueToPay,
				'ajax'=>true,
			));
		}
		else
		{
			$this->render('view',array(
				'model'=>$model,
				'guestName'=>$guestName,
				'paidValue'=>$paidValue,
				'totalValueToPay'=>$totalValueToPay,
			));
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Booking;
		// $this->performAjaxValidation($model);

		if(isset($_POST['Booking']))
		{
			$model->attributes = $_POST['Booking'];
			
			$model->value = $model->convertCommaToDot($model->value);
			
			$model->booking_date = date('Y-m-d');
			$model->id_employee = Yii::app()->user->getId();
			$model->id_payment = 1;
			
			if($model->validate())
			{
				$criteria = new CDbCriteria;
				$criteria->condition='email=:email';
				$criteria->params=array(':email'=>$model->client_email);
				$guest = Guest::model()->find($criteria);

				/*
				 * Verify space in room = [$model->id_room] 
				 * For x = [$model->night_num] days, 
				 * Starting at date = [$model->start_date]
				 */
				$start_date = $model->start_date;
				
				for($i = 0; $i < $model->night_num; $i++)
				{
					$xDays = ' +' . $i . ' day';
					$newDateWithXdays = strtotime(date("Y-m-d", strtotime($start_date)) . $xDays);
					$nextDate = date("Y-m-d", $newDateWithXdays);

					if( Room::model()->verifyDaySpace($model->id_room, $nextDate) < $model->bed_num )
					{
						$error = 'Creating Booking Days - The room ' . Room::model()->findByPk($model->id_room)->title . ' haven\'t space for day ' . $nextDate . '. Try another room, please.';
					}
				}
				
				if(!isset($error))
				{
					if(isset($guest->id))
					{
						$idGuest = $guest->id;
					}
					else // Cria cliente
					{
						$modelGuest=new Guest;
						$modelGuest->name = ucwords($model->client_name);
						$modelGuest->email = $model->client_email;
						$modelGuest->id_language = '1';
							
						if($modelGuest->save())
							$idGuest = $modelGuest->id;
						else
							$error = 'Creating Guest.. Try again';
					}
				
					if($idGuest != 0)
					{
						if($model->save())
						{
							/*
							 *	Cria registo na tabela de detalhes do booking
							 */
							/*$modelBookingDetails=new BookingDetails;
							$modelBookingDetails->id=$model->primaryKey;
							$modelBookingDetails->save();
							
							var_dump($model->save());
							
							var_dump(Yii::app()->db->getLastInsertID()); // " --- " . $model->primaryKey;*/
							
							$start_date = $model->start_date;
							
							for($i = 0; $i < $model->night_num; $i++)
							{
								$add = ' +' . $i . ' day';
								$newDate = strtotime(date("Y-m-d", strtotime($start_date)) . $add);
								$newDate = date("Y-m-d", $newDate);
		
								if( Room::model()->verifyDaySpace($model->id_room, $newDate) >= $model->bed_num )
								{
									$modelBookingDays=new BookingDays;
									$modelBookingDays->id_booking = $model->id;
									$modelBookingDays->day = $newDate;
									$modelBookingDays->id_supplier = $model->id_supplier;
									$modelBookingDays->id_room = $model->id_room;
									$modelBookingDays->bed_num = $model->bed_num;
									$modelBookingDays->supplier_rate = Supplier::model()->findByPk($model->id_supplier)->rate_value;
									//$modelBookingDays->price = ($model->value/$model->night_num/$model->bed_num);
									$modelBookingDays->price = $model->value * $model->bed_num;
			
									if(!$modelBookingDays->save())
										$error = 'Creating Booking -> Day  ( '.$newDate.' ) relation.. Try again';
								}
								else
								{
									$error = 'Creating Booking -> Booking day ' . $newDate . ' the room ' . $modelBookingDays->id_room . ' haven\'t space for day ' . $newDate;
								}
							}
							
							$modelBookingGuest=new BookingGuest;
							$modelBookingGuest->id_booking = $model->id;
							$modelBookingGuest->id_guest = $idGuest;
								
							if($modelBookingGuest->save()) // SUCESSO
								$this->redirect(array('view','id'=>$model->id));								
							else
								$error = 'Creating Booking -> Guest relation.. Try again';
						}
						else
							$error = 'Creating Booking.. Try again';
					}
					else
						$error = 'Creating User (0).. Try again';
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'error'=>$error,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);

		if(isset($_POST['Booking']))
		{
			$model->attributes=$_POST['Booking'];

			$criteria = new CDbCriteria;
			$criteria->condition='id_booking=:id_booking';
			$criteria->params=array(':id_booking'=>$model->id);

			$bookingDays = BookingDays::model()->findAll($criteria);
			
			foreach($bookingDays as $bookingDay)
			{
				$bookingDay->delete();
			}
		
			for($i = 0; $i < $model->night_num; $i++)
			{
				$add = ' +' . $i . ' day';
				$newDate = strtotime(date("Y-m-d", strtotime($model->start_date)) . $add);
				$newDate = date("Y-m-d", $newDate);
	
				if( Room::model()->verifyDaySpace($model->id_room, $newDate) >= $model->bed_num )
				{
					$modelBookingDays=new BookingDays;
					$modelBookingDays->id_booking = $model->id;
					$modelBookingDays->day = $newDate;
					$modelBookingDays->id_supplier = $model->id_supplier;
					$modelBookingDays->price = ($model->value*$model->bed_num);
					$modelBookingDays->id_room = $model->id_room;
					$modelBookingDays->bed_num = $model->bed_num;
					$modelBookingDays->supplier_rate = Supplier::model()->findByPk($model->id_supplier)->rate_value;
					
					//print_r($modelBookingDays);
		
					if(!$modelBookingDays->save())
						throw new CHttpException(403, 'Creating Booking -> Day  ( '.$newDate.' ) relation.. Try again');
				}
				else
				{
					$error = 'Update Booking in day ' . $newDate . ' the room ' . Room::model()->findByPk($model->id_room)->title . ' haven\'t space for that booking.';
					break;
				}
			}
			
			/*
			 * Update Guest Information
			 */
			if(!isset($error))
			{
				$criteria = new CDbCriteria;
				$criteria->condition='email=:email';
				$criteria->params=array(':email'=>$model->client_email);
				$modelGuest = Guest::model()->find($criteria);
				
				if(isset($modelGuest->id))
				{
					$modelGuest->name = ucwords($model->client_name);
					$modelGuest->save();
				}
				else // Cria cliente
				{
					$modelGuest=new Guest;
					$modelGuest->name = ucwords($model->client_name);
					$modelGuest->email = $model->client_email;
					$modelGuest->id_language = '1';
						
					if($modelGuest->save())
					{
						/*
						 * Altera o guest do booking
						 */
						$criteria->condition='id_booking=:id_booking';
						$criteria->params=array(':id_booking'=>$model->id);
						$modelBookingGuest = BookingGuest::model()->find($criteria);
						
						$modelBookingGuest->id_guest = $modelGuest->id;
						
						if(!$modelBookingGuest->save())
						{
							$error = 'Creating new relation of new Guest ' . $modelGuest->name . ' with the that booking - Try again, please.';
						}
					}
					else
						$error = 'Creating new Guest - Try again, please.';
				}
			}
			
			/*
			 * Update Booking Information
			 */
			if(!isset($error))
			{
				$model->value = $model->convertCommaToDot($model->value);
			
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'error'=>$error,
		));
	}
	
	public function actionUpdateEditable()
	{
	    $es = new EditableSaver('Booking');
	    /*$es->onBeforeUpdate = function($event) {
	        $event->sender->setAttribute('updated_at', date('Y-m-d H:i:s'));
	    };*/
	    $es->update();
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$criteria = new CDbCriteria;
			$criteria->condition='id_booking=:id_booking';
			$criteria->params=array(':id_booking'=>$id);
			$bookingDays = BookingDays::model()->findAll($criteria);
			
			foreach($bookingDays as $bookingDay)
			{
				$bookingDay->delete();
			}

			$criteria->condition='id_booking=:id_booking';
			$criteria->params=array(':id_booking'=>$id);
			$bookingGuests = BookingGuest::model()->findAll($criteria);
			
			foreach($bookingGuests as $bookingGuest)
			{
				$bookingGuest->delete();
			}			
			
			//booking_details
			
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('contentForm','ERROR_400'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Booking');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Booking('search');

		$model->value = $model->convertDotToComma($model->value);
			
		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded
    */
    public function loadModel($id)
    {
        $model=Booking::model()->findByPk($id);
        if($model===null)
        throw new CHttpException(404,Yii::t('contentForm','ERROR_404'));

        /*Substituir os pontos por virgulas*/
        $model->value = $model->convertDotToComma($model->value);

        return $model;
    }

    /**
    * Performs the AJAX validation.
    * @param CModel the model to be validated
    */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='booking-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
	
    public function actionAjaxStateUpdate()
    {
    	if(isset($_POST['id_booking']) && isset($_POST['id_state']))
		{
			$toReturn = '';
			
			try
			{
				$command = Yii::app()->db->createCommand();
				$command->update('booking', array(
					    'id_state'=>$_POST['id_state'],
					), 'id=:id', array(':id'=>$_POST['id_booking']));
				
				$toReturn = 'Updated !';
			}
			catch (Exception $ex)
			{
				$toReturn = $ex;
			}
			
			echo CJSON::encode(array(
			  'message'=>$toReturn,
			));
			
			Yii::app()->end();
		}
    }
    
    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAjaxCreate()
	{
		$model=new Booking;

		if(isset($_POST['Booking']))
		{
			$model->attributes = $_POST['Booking'];
			
			$model->value = $model->convertCommaToDot($model->value);
			
			$model->booking_date = date('Y-m-d');
			$model->id_employee = Yii::app()->user->getId();
			$model->id_payment = 1;
			
			if($model->validate())
			{
				$criteria = new CDbCriteria;
				$criteria->condition='email=:email';
				$criteria->params=array(':email'=>$model->client_email);
				$guest = Guest::model()->find($criteria);

				/*
				 * Verify space in room = [$model->id_room] 
				 * For x = [$model->night_num] days, 
				 * Starting at date = [$model->start_date]
				 */
				$start_date = $model->start_date;
				
				for($i = 0; $i < $model->night_num; $i++)
				{
					$xDays = ' +' . $i . ' day';
					$newDateWithXdays = strtotime(date("Y-m-d", strtotime($start_date)) . $xDays);
					$nextDate = date("Y-m-d", $newDateWithXdays);

					if( Room::model()->verifyDaySpace($model->id_room, $nextDate) < $model->bed_num )
					{
						$error = 'Creating Booking Days - The room ' . Room::model()->findByPk($model->id_room)->title . ' haven\'t space for day ' . $nextDate . '. Try another room, please.';
					}
				}
				
				if(!isset($error))
				{
					if(isset($guest->id))
					{
						$idGuest = $guest->id;
					}
					else // Cria cliente
					{
						$modelGuest=new Guest;
						$modelGuest->name = ucwords($model->client_name);
						$modelGuest->email = $model->client_email;
						$modelGuest->id_language = '1';
							
						if($modelGuest->save())
							$idGuest = $modelGuest->id;
						else
							$error = 'Creating Guest.. Try again';
					}
				
					if($idGuest != 0)
					{
						if($model->save())
						{
							/*
							 *	Cria registo na tabela de detalhes do booking
							 */
							$modelBookingDetails=new BookingDetails;
							$modelBookingDetails->id=$model->id;
							$modelBookingDetails->save();
							
							$start_date = $model->start_date;
								
							for($i = 0; $i < $model->night_num; $i++)
							{
								$add = ' +' . $i . ' day';
								$newDate = strtotime(date("Y-m-d", strtotime($start_date)) . $add);
								$newDate = date("Y-m-d", $newDate);
		
								if( Room::model()->verifyDaySpace($model->id_room, $newDate) >= $model->bed_num )
								{
									$modelBookingDays=new BookingDays;
									$modelBookingDays->id_booking = $model->id;
									$modelBookingDays->day = $newDate;
									$modelBookingDays->id_supplier = $model->id_supplier;
									$modelBookingDays->id_room = $model->id_room;
									$modelBookingDays->bed_num = $model->bed_num;
									$modelBookingDays->supplier_rate = Supplier::model()->findByPk($model->id_supplier)->rate_value;
									//$modelBookingDays->price = ($model->value/$model->night_num/$model->bed_num);
									$modelBookingDays->price = $model->value * $model->bed_num;
			
									if(!$modelBookingDays->save())
										$error = 'Creating Booking -> Day  ( '.$newDate.' ) relation.. Try again';
								}
								else
								{
									$error = 'Creating Booking -> Booking day ' . $newDate . ' the room ' . $modelBookingDays->id_room . ' haven\'t space for day ' . $newDate;
								}
							}
							
							$modelBookingGuest=new BookingGuest;
							$modelBookingGuest->id_booking = $model->id;
							$modelBookingGuest->id_guest = $idGuest;
								
							if($modelBookingGuest->save()) // SUCESSO
								$this->redirect($_GET["url"]);								
							else
								$error = 'Creating Booking -> Guest relation.. Try again';
						}
						else
							$error = 'Creating Booking.. Try again';
					}
					else
						$error = 'Creating User (0).. Try again';
				}
			}
		}
		
		$this->renderPartial('ajaxCreate',array(
			'model'=>$model,
			'error'=>$error,
			'ajaxRequest'=>true,
		));
	}
	
	/**
	 * Updates a particular model.
	 * Ajax Call from external Controllers/Views
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionAjaxUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Booking']))
		{
			$model->attributes=$_POST['Booking'];

			$criteria = new CDbCriteria;
			$criteria->condition='id_booking=:id_booking';
			$criteria->params=array(':id_booking'=>$model->id);

			$bookingDays = BookingDays::model()->findAll($criteria);
			
			foreach($bookingDays as $bookingDay)
			{
				$bookingDay->delete();
			}
		
			for($i = 0; $i < $model->night_num; $i++)
			{
				$add = ' +' . $i . ' day';
				$newDate = strtotime(date("Y-m-d", strtotime($model->start_date)) . $add);
				$newDate = date("Y-m-d", $newDate);
	
				if( Room::model()->verifyDaySpace($model->id_room, $newDate) >= $model->bed_num )
				{
					$modelBookingDays=new BookingDays;
					$modelBookingDays->id_booking = $model->id;
					$modelBookingDays->day = $newDate;
					$modelBookingDays->id_supplier = $model->id_supplier;
					$modelBookingDays->price = ($model->value*$model->bed_num);
					$modelBookingDays->id_room = $model->id_room;
					$modelBookingDays->bed_num = $model->bed_num;
					$modelBookingDays->supplier_rate = Supplier::model()->findByPk($model->id_supplier)->rate_value;
		
					if(!$modelBookingDays->save())
						throw new CHttpException(403, Yii::t('contentForm','ERROR_403{newDate}', array('{newDate}'=>$newDate)));
				}
				else
				{
					$error = 'Update Booking in day ' . $newDate . ' the room ' . Room::model()->findByPk($model->id_room)->title . ' haven\'t space for that booking.';
					break;
				}
			}
			
			/*
			 * Update Guest Information
			 */
			if(!isset($error))
			{
				$criteria = new CDbCriteria;
				$criteria->condition='email=:email';
				$criteria->params=array(':email'=>$model->client_email);
				$modelGuest = Guest::model()->find($criteria);
				
				if(isset($modelGuest->id))
				{
					$modelGuest->name = ucwords($model->client_name);
					$modelGuest->save();
				}
				else // Cria cliente
				{
					$modelGuest=new Guest;
					$modelGuest->name = ucwords($model->client_name);
					$modelGuest->email = $model->client_email;
					$modelGuest->id_language = '1';
						
					if($modelGuest->save())
					{
						/*
						 * Altera o guest do booking
						 */
						$criteria->condition='id_booking=:id_booking';
						$criteria->params=array(':id_booking'=>$model->id);
						$modelBookingGuest = BookingGuest::model()->find($criteria);
						
						$modelBookingGuest->id_guest = $modelGuest->id;
							
						if(!$modelBookingGuest->save())
						{
							$error = 'Creating new relation of new Guest ' . $modelGuest->name . ' with the that booking - Try again, please.';
						}
					}
					else
						$error = 'Creating new Guest - Try again, please.';
				}
			}
			
			/*
			 * Update Booking Information
			 */
			if(!isset($error))
			{
				$model->value = $model->convertCommaToDot($model->value);
			
				if($model->save())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->renderPartial('ajaxUpdate',array(
			'model'=>$model,
			'error'=>$error,
		));
	}
    
    public function actionPdfView($id)
    {
        $mPDF1 = Yii::app()->ePdf->mpdf();
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
 
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        $mPDF1->WriteHTML($stylesheet, 1);
        
        $mPDF1->WriteHTML($this->renderPartial('pdfView', array('model'=>$this->loadModel($id)), true));
        
        $mPDF1->Output();
    }
	
    /*
    * called on rendering the column for each row - Admin zii.widgets.grid.CGridView
    * Receive Booking model ($data)
    * Return Client Name
    */
    protected function gridGuestNameColumn($data, $row)
    {
    	$modelGuest = Guest::model()->findByPk($data->bookingGuest[0]->id_guest);
		
    	return $modelGuest->name;
    }
	
    /*
    * called on rendering the column for each row - Admin zii.widgets.grid.CGridView
    * Receive Booking model ($data)
    * Return Room Name
    */
    protected function gridRoomNameColumn($data, $row)
    {
    	$modelRoom = Room::model()->findByPk($data->bookingDays[0]->id_room);
		
    	return $modelRoom->title;
    }
	
    /*
    * called on rendering the column for each row - Admin zii.widgets.grid.CGridView
    * Receive Booking model ($data)
    * Return Paid State Description
    */
    protected function gridPaidDescription($data, $row)
    {
    	if($data->paid == '1')
        {
            return 'Paid';
        }
        else
        {
            return 'Not Paid';
        }
    }
	
	/*
	 * Save bookingViewTab session
	 */
	public function actionUpdateBookingViewTab($id)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab1';
		
		exit;
	}
	
	public function actionViewDetails($id)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab1';
		
		$model = $this->loadModel($id);
		$guestName = CHtml::encode($model->bookingGuest[0]->guest->name);
		
		$model->id_supplier = $model->bookingDays[0]->id_supplier;
		$model->id_room = $model->bookingDays[0]->id_room;
		
		$totalValueToPay = $model->getTotalValueByBookingId($model->id, $model->value);
		
		if($model->paid == '0') $paidValue = Yii::t('contentForm','NOT_PAID');
		else			$paidValue = Yii::t('contentForm','PAID');
		
		$this->renderPartial('viewDetails',array(
			'model'=>$model,
			'guestName'=>$guestName,
			'paidValue'=>$paidValue,
			'totalValueToPay'=>$totalValueToPay,
		));
	}
	
	public function actionViewDays($id)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab2';
		
		$model = $this->loadModel($id);
		
		$bookingDays=new CActiveDataProvider('BookingDays', array(
		    'criteria'=>array(
		        'condition'=>'id_booking=:id_booking',
		        'params'=>array(':id_booking'=>$model->id),
		    ),
		    'pagination' => array(
	            'pageSize' => 90,
	        ),
		));
		
		$this->renderPartial('viewDays',array(
			'model'=>$model,
			'bookingDays'=>$bookingDays,
		));
	}
	
	public function actionViewGuest($id)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab3';
		
		$guestList = array();
		$guestName = null;
		$model = $this->loadModel($id);

		// Saca lista de clientes associados à reserva
		foreach($model->bookingGuest as $guest)
		{
		    $guestList[] = CHtml::link(CHtml::encode($guest->guest->name),array('guest/view','id'=>$guest->guest->id)) . ' ';
		    $guestName = CHtml::encode($guest->guest->name);
		}
		
		$guestsList=new CActiveDataProvider('BookingGuest', array(
		    'criteria'=>array(
		        'condition'=>'id_booking=:id_booking',
		        'params'=>array(':id_booking'=>$model->id),
		    ),
		    'pagination' => array(
	            'pageSize' => 90,
	        ),
		));
		
		$this->renderPartial('viewGuest',array(
			'model'=>$model,
			'guestsList'=>$guestsList,
			'guestName'=>$guestName,
		));
	}
	
	/*
	 *	Get Suppliers Details on a DataProvider
	 *
	 *	idBooking - Booking Identifier
	 *  idSupplier - Supplier Identifier
	 */
	public function actionViewSupplier($idBooking, $idSupplier, $totalToPay)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab4';
		
		$model = Supplier::model()->findByPk($idSupplier);
		
		$retainedValue = $totalToPay * ($model->rate_value/100);
		$retainedValueEur =  $retainedValue . " " . Yii::t('contentForm','EUR');
		
		$this->renderPartial('viewSupplier',array(
			'model'=>$model,
			'retainedValueEur'=>$retainedValueEur,
		));
	}
	
	public function renderButtons($data, $row)
	{
		$clientList = array();

		$clientName = $data->guests[0]->name;

		foreach($data->guests as $guest)
		{
			$clientList[] = array('label'=>$guest->name, 'url'=>$this->createUrl('guest/view', array("id"=>$guest->id)));
		}

		$this->widget('bootstrap.widgets.TbButtonGroup', array(
			//'size'=>'mini',
			'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'buttons'=>array(
				array('label'=>$this->gridGuestNameColumn($data, $row), 'items'=>$clientList),
			),
		));
	}
	
	public function actionVerifyRoomSpaceAvailability($idRoom, $nightNum, $bedNum, $startDate)
	{
		$availability = true;
		
		for($i = 0; $i < $nightNum; $i++)
		{
			$xDays = ' +' . $i . ' day';
			$newDateWithXdays = strtotime(date("Y-m-d", strtotime($startDate)) . $xDays);
			$nextDate = date("Y-m-d", $newDateWithXdays);

			if(Room::model()->verifyDaySpace($idRoom, $nextDate) < $bedNum)
			{
				$availability=false;
		        break;
			}
		}
		
		echo CJSON::encode(array(
            'availability'=>$availability,
        ));
	}
	
	public function actionViewPackages($idBooking)
	{
		Yii::app()->session['bookingViewTab'] = 'linkBookingTab5';
		
		$model = $this->loadModel($idBooking);
		
		$packagesList=new CActiveDataProvider('BookingPackage', array(
		    'criteria'=>array(
		        'condition'=>'id_booking=:id_booking',
		        'params'=>array(':id_booking'=>$model->id),
		    ),
		    'pagination' => array(
	            'pageSize' => 90,
	        ),
		));
		
		$this->renderPartial('viewPackages',array(
			'model'=>$model,
			'packagesList'=>$packagesList,
		));
	}
	
	public function actionViewCreateBookingPackage($idBooking)
    {
    	$model=new BookingPackage;
    	$model->id_booking=$idBooking;
    	
		if(isset($_GET["ajax"]))
		{
			$this->renderPartial('_minimalistForm',array(
	            'model'=>$model,
	        ));
		}
		else
		{
			exit;
		}
    }
    
    private function getBookingPackageRelation($idBooking, $idPackage)
    {
    	$criteria = new CDbCriteria;
		$criteria->condition='id_booking=:id_booking AND id_package=:id_package';
		$criteria->params=array(':id_booking'=>$idBooking, ':id_package'=>$idPackage);
		$modelBookingPackage = BookingPackage::model()->find($criteria);
		
		return $modelBookingPackage;
    }
	
	public function actionAssociateBookingPackage($idBooking, $idPackage)
    {
    	/**
    	 * 	Criar a relação só e só se esta não existir
    	 */
    	if($this->getBookingPackageRelation($idBooking, $idPackage) == null)
    	{    	
			$modelBookingPackage=new BookingPackage;
			$modelBookingPackage->id_booking = $idBooking;
			$modelBookingPackage->id_package = $idPackage;
			
			if(!$modelBookingPackage->save())
			{
				echo CJSON::encode(array(
		            'error'=>true,
		            'message'=>'Error when try to associated the package to the booking.. Try again..',
		        ));
				
			}
			else
			{
				echo CJSON::encode(array(
		            'error'=>false,
		            'message'=>'Package was successfully associated to booking !',
		        ));
			}
    	}
    	else
		{
			echo CJSON::encode(array(
	            'error'=>true,
	            'message'=>'The package is already associated to the booking.',
	        ));
		}
    }
    
    public function actionDeassociateBookingPackage($idBooking, $idPackage)
    {
		$modelBookingPackage=$this->getBookingPackageRelation($idBooking, $idPackage);
		
		if(!($modelBookingPackage == null))
		{
			if(!$modelBookingPackage->delete())
			{
				echo CJSON::encode(array(
		            'error'=>true,
		            'message'=>'Error when try to deassociated the package to the booking.. Try again..',
		        ));
			}
			else
			{
				echo CJSON::encode(array(
		            'error'=>false,
		            'message'=>'Package was successfully deassociated from booking !',
		        ));
			}
		}
		else
		{
			echo CJSON::encode(array(
	            'error'=>true,
	            'message'=>'The package, that you are trying to remove isn\'t associated to the booking.',
	        ));
		}
    }
}
