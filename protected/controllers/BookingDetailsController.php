<?php

class BookingDetailsController extends Controller
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
			array('allow',
				'actions'=>array('index','view','create','update','updateEditable'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'expression'=>'$user->isAdmin()',
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
		$model=new BookingDetails;
		// $this->performAjaxValidation($model);

		if(isset($_POST['BookingDetails']))
		{
			$model->attributes=$_POST['BookingDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_booking));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// $this->performAjaxValidation($model);

		if(isset($_POST['BookingDetails']))
		{
			$model->attributes=$_POST['BookingDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_booking));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateEditable()
	{
	    $es = new EditableSaver('BookingDetails');
	    $es->update();
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
		$dataProvider=new CActiveDataProvider('BookingDetails');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new BookingDetails('search');
		$model->unsetAttributes();
		if(isset($_GET['BookingDetails']))
			$model->attributes=$_GET['BookingDetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=BookingDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='booking-guest-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
