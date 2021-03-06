<?php

class PaymentController extends Controller
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
                'actions'=>array('index','view'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','admin','delete'),
                'expression'=>'$user->isAdmin()',
            ),
            array('deny',  // deny all users
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
            $model=new Payment;

            $this->performAjaxValidation($model);

            if(isset($_POST['Payment']))
            {
                    $model->attributes=$_POST['Payment'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
    }

    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);

            $this->performAjaxValidation($model);

            if(isset($_POST['Payment']))
            {
                    $model->attributes=$_POST['Payment'];
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
            $dataProvider=new CActiveDataProvider('Payment');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    public function actionAdmin()
    {
            $model=new Payment('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Payment']))
                    $model->attributes=$_GET['Payment'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    public function loadModel($id)
    {
            $model=Payment::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='payment-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
