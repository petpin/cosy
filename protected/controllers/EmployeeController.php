<?php

class EmployeeController extends Controller
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
                'expression'=>'!$user->isGuest',
            ),
            array('allow',
                'actions'=>array('create','update','updateEditable','admin','delete'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('deny', 
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
        $model=new Employee;

        $this->performAjaxValidation($model);

        if(isset($_POST['Employee']))
        {
            $model->attributes=$_POST['Employee'];
            
            $model->password = 'zxcvbnm';
            
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
        
    	if(isset($_POST['Employee']))
		{
		    $model->attributes=$_POST['Employee'];		    
		    if($model->save())
		    {
		       	$this->redirect(array('view','id'=>$model->id));
		    }
		}
	    
    	$this->render('update',array(
            'model'=>$model,
        ));
    }
    
    public function actionUpdateEditable()
	{
	    $es = new EditableSaver('Employee');
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
            $dataProvider=new CActiveDataProvider('Employee');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    public function actionAdmin()
    {
            $model=new Employee('search');

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    public function loadModel($id)
    {
            $model=Employee::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='employee-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
}
