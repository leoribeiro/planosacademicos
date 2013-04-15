<?php

class ModalidadeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

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
			//array('allow',  // allow all users to perform 'index' and 'view' actions
			//	'actions'=>array('index','view'),
			//	'users'=>array('*'),
			//),
			//array('allow', // allow authenticated user to perform 'create' and 'update' actions
			//	'actions'=>array('create','update'),
			//	'users'=>array('@'),
			//),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view','create','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Modalidade;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Modalidade']))
		{
			$model->attributes=$_POST['Modalidade'];
			if($model->save()){
				if( Yii::app()->request->isAjaxRequest )
				{
				        // Stop jQuery from re-initialization
				        Yii::app()->clientScript->scriptMap['jquery.js'] = false;

				        echo CJSON::encode( array(
				          'status' => 'success',
				          'content' => 'Registro inserido com sucesso!',
				        ));
				        exit;
				 }
				else
					$this->redirect(array('view','id'=>$model->CDModalidade));
			}
				
		}
		
		if( Yii::app()->request->isAjaxRequest )
		  {
		    // Stop jQuery from re-initialization
		    Yii::app()->clientScript->scriptMap['jquery.js'] = false;

		    echo CJSON::encode( array(
		      'status' => 'failure',
		      'content' => $this->renderPartial( '_form', array(
		        'model' => $model ), true, true ),
		    ));
		    exit;
		  }
		  else {
			$this->render('create',array(
				'model'=>$model,
			));
		}


	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Modalidade']))
		{
			$model->attributes=$_POST['Modalidade'];
			if($model->save())
			{
			 if( Yii::app()->request->isAjaxRequest )
			      {
			        // Stop jQuery from re-initialization
			        Yii::app()->clientScript->scriptMap['jquery.js'] = false;

			        echo CJSON::encode( array(
			          'status' => 'success',
			          'content' => 'ModelName successfully updated',
			        ));
			        exit;
			      }
			      else
					$this->redirect(array('admin'));
			}
		}
		
		if( Yii::app()->request->isAjaxRequest )
		  {
		    // Stop jQuery from re-initialization
		    Yii::app()->clientScript->scriptMap['jquery.js'] = false;

		    echo CJSON::encode( array(
		      'status' => 'failure',
		      'content' => $this->renderPartial( '_form', array(
		        'model' => $model ), true, true ),
		    ));
		    exit;
		  }
		  else
		  {
				$this->render('update',array(
					'model'=>$model,
				));
		  }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Modalidade');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Modalidade('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Modalidade']))
			$model->attributes=$_GET['Modalidade'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Modalidade::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='modalidade-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}