<?php

class ProfessorDisciplinaController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
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
		$model=new ProfessorDisciplina;
		$model->id_professor = $id;
		$dados = $this->carregaDisciplinas($id);
		$discs = $dados[0];
		$turmas = $dados[1];

		$dados = array($discs,$turmas);

		$this->render('view',array(
			'model'=>$model,'dados'=>$dados
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProfessorDisciplina;
		$discs = array();
		$turmas = array();

		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model->id_professor = $id;
			$dados = $this->carregaDisciplinas($id);
			$discs = $dados[0];
			$turmas = $dados[1];
		}



		if(isset($_POST['ProfessorDisciplina']))
		{

			$model->attributes=$_POST['ProfessorDisciplina'];

			if(isset($_POST['discS']) && isset($_POST['turmaS'])){
				$discs = $_POST['discS'];
				$turmas = $_POST['turmaS'];
			}
			if($model->validate()){
				if(empty($discs) && empty($turmas)){
					$model->addError('id_disciplina','Deve-se selecionar pelo menos uma disciplina.');
				}
				else{
					$this->deletarDependecias($model->id_professor);
					for($x=0;$x<count($discs);$x++){
						$m = new ProfessorDisciplina;
						$m->id_professor = $model->id_professor;
						$m->id_disciplina = $discs[$x];
						$m->id_turma = $turmas[$x];
						$m->save();
					}
					$this->redirect(array('admin','success'=>true));
				}
			}
		}

		$dados = array($discs,$turmas);

		$this->render('create',array(
			'model'=>$model,'dados'=>$dados
		));
	}

	function deletarDependecias($id){

		$criteria = new CDbCriteria();
		$criteria->compare('id_professor',$id);
		ProfessorDisciplina::model()->deleteAll($criteria);

	}

	function carregaDisciplinas($id){

		// Avaliações
		$criteria = new CDbCriteria();
		$criteria->compare('id_professor',$id);
		$modelP = ProfessorDisciplina::model()->findAll($criteria);
		$idsT = array();
		$idsD = array();
		foreach($modelP as $p){
			$idsD[] = $p->id_disciplina;
			$idsT[] = $p->id_turma;
		}

		$dados = array($idsD,$idsT);

		return $dados;

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProfessorDisciplina']))
		{
			$model->attributes=$_POST['ProfessorDisciplina'];
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
			// we only allow deletion via POST request
			$criteria = new CDbCriteria;
			$criteria->compare('id_professor',$id);
			ProfessorDisciplina::model()->deleteAll($criteria);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
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
		$dataProvider=new CActiveDataProvider('ProfessorDisciplina');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if(isset($_GET['success'])) {

			Yii::app()->user->setFlash('success', 'Disciplinas do professor salvas com sucesso!');

		}
		$model=new ProfessorDisciplina('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProfessorDisciplina']))
			$model->attributes=$_GET['ProfessorDisciplina'];

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
		$model=ProfessorDisciplina::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='professor-disciplina-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
