<?php

class EmployeeTypeController extends Controller
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
                'actions'=>array('index','view','create','update','admin','delete'),
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
        $model=new EmployeeType;

        $this->performAjaxValidation($model);

        if(isset($_POST['EmployeeType']))
        {
            $model->attributes=$_POST['EmployeeType'];
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

        if(isset($_POST['EmployeeType']))
        {
            $model->attributes=$_POST['EmployeeType'];
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
        $dataProvider=new CActiveDataProvider('EmployeeType');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $model=new EmployeeType('search');
        $model->unsetAttributes();
        if(isset($_GET['EmployeeType']))
            $model->attributes=$_GET['EmployeeType'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model=EmployeeType::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='employee-type-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
