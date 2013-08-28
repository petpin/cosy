<?php

class RoomTypeController extends Controller
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
                    'expression'=>'!Yii::app()->user->isGuest',
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
        $model=new RoomType;

        $this->performAjaxValidation($model);

        if(isset($_POST['RoomType']))
        {
                $model->attributes=$_POST['RoomType'];
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

            if(isset($_POST['RoomType']))
            {
                    $model->attributes=$_POST['RoomType'];
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
            $dataProvider=new CActiveDataProvider('RoomType');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    public function actionAdmin()
    {
            $model=new RoomType('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['RoomType']))
                    $model->attributes=$_GET['RoomType'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    public function loadModel($id)
    {
            $model=RoomType::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='room-type-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
