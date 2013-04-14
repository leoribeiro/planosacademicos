<?php

class TurmaController extends Controller
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
	
	// Adicionado para usar o componente UpdateDialog
	/**public function actions()
	{
	  return array(
	    'create' => 'application.actions.createAction',
	    'delete' => 'application.actions.deleteAction',
	    'update' => 'application.actions.updateAction',
	  );
	}

	*/	
	public function actionAtualizaSelect() {
		$lista =CHtml::listData(Modalidade::model()->findAll(), 'CDModalidade', 'NMModalidade');
		$data = CHtml::activeDropDownList($model,'CDModalidade',$lista,array('empty'=>'Escolha a modalidade'));
		echo '<option>ass</option>';
	}
	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('AdicionaDisciplina','RemoveDisciplina','UpdateDisciplina'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view','create','update','AdicionaDisciplina','RemoveDisciplina','UpdateDisciplina'),
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
	
	public function actionAdicionaDisciplina()
	{
		if(isset($_POST['DisciplinasDisponiveis'])){
			$disciplinas = $_POST['DisciplinasDisponiveis'];
			
			// Não sei se é uma forma elegante, mas ainda não consegui resolver isto.
			// Usando uma variável de sessão para gravar as disciplinas escolhidas.
			if(!isset(Yii::app()->session['DisciplinasEscolhidas'])){
				$DisciplinasEscolhidas = array();	
			}
			else{
				$DisciplinasEscolhidas = Yii::app()->session['DisciplinasEscolhidas'];	
			}
			foreach($disciplinas as $disc){
				if(!in_array($disc,$DisciplinasEscolhidas))
					$DisciplinasEscolhidas[] = $disc;
			}	
			Yii::app()->session['DisciplinasEscolhidas'] = $DisciplinasEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDDisciplina', $DisciplinasEscolhidas);
			$criteria->order = 'NMDisciplina';
			$DisciplinasBanco=Disciplina::model()->findAll($criteria);
		    $resultado=CHtml::listData($DisciplinasBanco,'CDDisciplina','NMDisciplina');
		    $controleSelected = true;
		    foreach($resultado as $value=>$name)
		    {
				if($controleSelected){
					echo CHtml::tag('option',
			                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
				    $controleSelected = false;
				}
				else{
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
				}
		        
		    }
		

		}
	
	}


	public function actionRemoveDisciplina()
	{
		//melhorar isto
		if((isset($_POST['Turma']['relTurmaDisciplina'])) and (isset(Yii::app()->session['DisciplinasEscolhidas']))){
			
			$disciplinas = $_POST['Turma']['relTurmaDisciplina'];
			$DisciplinasEscolhidas = Yii::app()->session['DisciplinasEscolhidas'];
			
			$DisciplinasEscolhidas = array_diff($DisciplinasEscolhidas, $disciplinas);
					
			Yii::app()->session['DisciplinasEscolhidas'] = $DisciplinasEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDDisciplina', $DisciplinasEscolhidas);
			$criteria->order = 'NMDisciplina';
			$DisciplinasBanco=Disciplina::model()->findAll($criteria);
		    $resultado=CHtml::listData($DisciplinasBanco,'CDDisciplina','NMDisciplina');
		    $controleSelected = true;
		    foreach($resultado as $value=>$name)
		    {
				if($controleSelected){
					echo CHtml::tag('option',
			                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
				    $controleSelected = false;
				}
				else{
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
				}
		        
		    }
		

		}
	
	}
	
	public function actionUpdateDisciplina()
	{
		if(isset($_POST['CDDepartamento'])){
			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->compare('CDDepartamento',$_POST['CDDepartamento']);
			$criteria->order = 'NMDisciplina';
			$DisciplinasBanco=Disciplina::model()->findAll($criteria);
		    $resultado=CHtml::listData($DisciplinasBanco,'CDDisciplina','NMDisciplina');
		    $controleSelected = true;
		    foreach($resultado as $value=>$name)
		    {
				if($controleSelected){
					echo CHtml::tag('option',
			                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
				    $controleSelected = false;
				}
				else{
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
				}
		        
		    }

		}
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Turma;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Turma']))
		{
			$model->attributes=$_POST['Turma'];
			
			if(isset(Yii::app()->session['DisciplinasEscolhidas'])){
				$model->relTurmaDisciplina = Yii::app()->session['DisciplinasEscolhidas'];
			}
			 
			if($model->save())
			{
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
					    $this->redirect(array('view','id'=>$model->CDTurma));
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

		if(isset($_POST['Turma']))
		{
			$model->attributes=$_POST['Turma'];
			
			if(isset(Yii::app()->session['DisciplinasEscolhidas'])){
				$model->relTurmaDisciplina = Yii::app()->session['DisciplinasEscolhidas'];
			}
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('Turma');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Turma('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Turma']))
			$model->attributes=$_GET['Turma'];

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
				$this->_model=Turma::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='turma-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
