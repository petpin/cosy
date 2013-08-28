<?php

class RoomController extends Controller
{
    public $layout='//layouts/column1';

    public function filters()
    {
            return array(
                    'accessControl',
            );
    }

    public function actions()
    {
        return array(
            'availability'=>'application.controllers.room.AvailabilityAction',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  
                'actions'=>array('index','view'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('allow', 
                'actions'=>array('create','update','admin','delete'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('deny',  
                'users'=>array('*'),
            ),
        );
    }

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new Room;
		$this->performAjaxValidation($model);
		
		$roomNumber = Room::model()->count();
		$maxRoom = Yii::app()->params['maxRooms'];
		
		if($maxRoom > $roomNumber)
		{
			if(isset($_POST['Room']))
			{
				$model->attributes=$_POST['Room'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$this->performAjaxValidation($model);

		if(isset($_POST['Room']))
		{
				$model->attributes=$_POST['Room'];
				if($model->save())
						$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
            if(Yii::app()->request->isPostRequest)
            {
                $this->loadModel($id)->delete();

                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
            $dataProvider=new CActiveDataProvider('Room');
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
	}

	public function actionAdmin()
	{
            $model=new Room('search');
            $model->unsetAttributes();
            
            if(isset($_GET['Room']))
                $model->attributes=$_GET['Room'];

            $this->render('admin',array(
                'model'=>$model,
            ));
	}

	public function loadModel($id)
	{
		$model=Room::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='room-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
