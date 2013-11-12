<?php

class GuestController extends Controller
{
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index', 'view'),
                'expression'=>'!$user->isGuest',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create', 'update', 'updateEditable', 'getEmails', 'getNames', 'associateBookingGuest'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin', 'delete'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionView($id)
    {
    	if( Yii::app()->request->isAjaxRequest )
        {
	        $this->renderPartial('view',array(
	            'model'=>$this->loadModel($id),
	        ), false, true);
	    }
	    else
	    {
	        $this->render('view',array(
	            'model'=>$this->loadModel($id),
	        ));
	    }
    }

    public function actionCreate()
    {
        $model=new Guest;
        
        if(isset($_GET['idBooking']))
        {
      		$model->id = $_GET['idBooking'];
        }

        $this->performAjaxValidation($model);

        if(isset($_POST['Guest']))
        {
			$model->attributes=$_POST['Guest'];
			
        	$criteria = new CDbCriteria;
			$criteria->condition='email=:email';
			$criteria->params=array(':email'=>$model->email);
			$guest = Guest::model()->find($criteria);
        	
            if(isset($guest->id))
			{
				$idGuest = $guest->id;
			}
			else // Nao existe - Cria cliente
			{
            	$model->name = ucwords($model->name);
					
				if($model->save())
            	{
            		$idGuest = $model->id;
            		//$this->redirect(array('view', 'id'=>$model->id));
            	}
			}
            
        	if($model->idBooking != '')
        	{
        		$modelBookingGuest=new BookingGuest;
				$modelBookingGuest->id_booking = $model->idBooking;
				$modelBookingGuest->id_guest = $idGuest;
				
				if(!$modelBookingGuest->save())
        			$error = 'Error when try to associated the new Guest to an existent Booking.';
        	}
        	
        	$this->redirect(array('view', 'id'=>$idGuest));
        }

		if(isset($_GET["ajax"]))
		{
			$this->renderPartial('_minimalistForm',array(
	            'model'=>$model,
	        ));
		}
		else
		{
			$this->render('create',array(
	            'model'=>$model,
	        ));
		}
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        $this->performAjaxValidation($model);

        if(isset($_POST['Guest']))
        {
            $model->attributes=$_POST['Guest'];
            
            $model->name = ucwords($model->name);
            
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    
	public function actionUpdateEditable()
	{
	    $es = new EditableSaver('Guest');
	    $es->update();
	}

    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
        	$criteria = new CDbCriteria;
			$criteria->condition='id_guest=:id_guest';
			$criteria->params=array(':id_guest'=>$id);
			$bookingGuests = BookingGuest::model()->find($criteria);
        	
        	foreach($bookingGuests as $bookingGuest)
			{
				$bookingGuest->delete();
			}
        	
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Guest');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model=new Guest('search');
        
        $this->render('admin',array(
                'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model=Guest::model()->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='guest-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
    }
    
    function actionGetNames()
    {
		$res=array();
	
		if (isset($_GET['term']))
		{
			$criteria = new CDbCriteria;
			$criteria->condition='name LIKE :name';
			$criteria->params=array(':name'=>$_GET['term']);
			$guest = Guest::model()->find($criteria);
			
			$qtxt ="SELECT name FROM guest WHERE name LIKE :name";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":name", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
		}
	
		echo CJSON::encode($res);
		Yii::app()->end();
	}
	
	function actionGetEmails()
    {
		$res=array();
	
		if (isset($_GET['term']))
		{
			$criteria = new CDbCriteria;
			$criteria->condition='email LIKE :email';
			$criteria->params=array(':email'=>$_GET['term']);
			$guest = Guest::model()->find($criteria);
			
			$qtxt ="SELECT email FROM guest WHERE email LIKE :email";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":email", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
		}
	
		echo CJSON::encode($res);
		Yii::app()->end();
	}
	
	public function actionAssociateBookingGuest($guestName, $guestEmail, $guestPhone, $idBooking)
    {
    	$criteria = new CDbCriteria;
		$criteria->condition='email LIKE :email';
		$criteria->params=array(':email'=>$guestEmail);
		$guest = Guest::model()->find($criteria);
		
		if(isset($guest->id))
		{
			$idGuest = $guest->id;
		}
		else // Nao existe - Cria cliente
		{
			$model=new Guest;
			
			$model->name = ucwords($guestName);
			$model->email = $guestEmail;
			$model->phone = $guestPhone;
			
			//echo " guestName = $guestName | guestEmail = $guestEmail | guestPhone = $guestPhone ";
			
			if(!$model->save())
        	{
        		echo CHtml::encode('Error when try to create the new Guest.. Try again..');
        		break;
        	}
        	else
        	{
        		$idGuest = $model->id;
        	}
		}
    	
    	if($idGuest != '')
    	{
    		$modelBookingGuest=new BookingGuest;
			$modelBookingGuest->id_booking = $idBooking;
			$modelBookingGuest->id_guest = $idGuest;
			
			if(!$modelBookingGuest->save())
    			echo CHtml::encode('Error when try to associated the new Guest to an existent Booking.. Try again..');
    		else
    			echo CHtml::encode('Guest was successfully associated to Booking !');
    	}
    }
}
