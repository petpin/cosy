<?php

class SupplierController extends Controller
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
            $model=new Supplier;

            $this->performAjaxValidation($model);

            if(isset($_POST['Supplier']))
            {
                    $model->attributes=$_POST['Supplier'];
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

            if(isset($_POST['Supplier']))
            {
                    $model->attributes=$_POST['Supplier'];
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
                    throw new CHttpException(400,Yii::t('contentForm','ERROR_400'));
    }

    public function actionIndex()
    {
            $dataProvider=new CActiveDataProvider('Supplier');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    public function actionAdmin()
    {
            $model=new Supplier('search');

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    public function loadModel($id)
    {
            $model=Supplier::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,Yii::t('contentForm','ERROR_404'));
            return $model;
    }

    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='supplier-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
