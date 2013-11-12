<?php

class PackageController extends Controller
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
                'actions'=>array('index','view','viewService'),
                'expression'=>'!$user->isGuest && ($user->isManager() || $user->isAdmin())',
            ),
            array('allow', 
                'actions'=>array('create','update','updateEditable','admin','delete','viewCreateServicePackage','associateServicePackage','deassociateServicePackage'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Package;
		// $this->performAjaxValidation($model);

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			
			$model->creation_date=date('Y-m-d H:i:s');
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdateEditable()
	{
	    $es = new EditableSaver('Package');
	    $es->update();
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

		if(isset($_POST['Package']))
		{
			$model->attributes=$_POST['Package'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Package');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Package('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Package']))
			$model->attributes=$_GET['Package'];

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
		$model=Package::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='package-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionViewService($idPackage)
	{
		Yii::app()->session['packageViewTab'] = 'linkPackageTab2';
		
		$model = $this->loadModel($idPackage);
		
		//var_dump($model->services);
		
		$servicesList=new CActiveDataProvider('ServicePackage', array(
		    'criteria'=>array(
		        'condition'=>'id_package=:id_package',
		        'params'=>array(':id_package'=>$model->id),
		    ),
		    'pagination' => array(
	            'pageSize' => 90,
	        ),
		));
		
		$this->renderPartial('viewService',array(
			'model'=>$model,
			'servicesList'=>$servicesList,
		));
	}
	
	public function actionViewCreateServicePackage($idPackage)
    {
    	$model=new ServicePackage;
    	$model->id_package=$idPackage;
    	
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
	
	private function getServicePackageRelation($idPackage, $idService)
    {
    	$criteria = new CDbCriteria;
		$criteria->condition='id_package=:id_package AND id_service=:id_service';
		$criteria->params=array(':id_package'=>$idPackage, ':id_service'=>$idService);
		$modelServicePackage = ServicePackage::model()->find($criteria);
		
		return $modelServicePackage;
    }
	
	public function actionAssociateServicePackage($idPackage, $idService)
    {
    	/**
    	 * 	Criar a relação só e só se esta não existir
    	 */
    	if($this->getServicePackageRelation($idPackage, $idService) == null)
    	{    	
			$modelServicePackage=new ServicePackage;
			$modelServicePackage->id_package = $idPackage;
			$modelServicePackage->id_service = $idService;
			
			if(!$modelServicePackage->save())
			{
				echo CJSON::encode(array(
		            'error'=>true,
		            'message'=>'Error when try to associated the new Service to the Package.. Try again..',
		        ));
				
			}
			else
			{
				echo CJSON::encode(array(
		            'error'=>false,
		            'message'=>'Service was successfully associated to package !',
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
    
    public function actionDeassociateServicePackage($idPackage, $idService)
    {
		$modelServicePackage=$this->getServicePackageRelation($idPackage, $idService);
		
		if(!($modelServicePackage == null))
		{
			if(!$modelServicePackage->delete())
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
