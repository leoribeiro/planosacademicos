<?php

class PAMarcacaoProvaController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','viewM'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','atualizahorariosForm','admin','adminHistorico','delete','provaHistorico'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','adminHistorico','delete','index','view','create','update','viewM'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAtualizahorariosForm()
	{
		$turma = $_POST['turma'];
		if(!is_null($_POST['inicio']))
			$marcacao = $_POST['inicio'];

	    $data=Horario::model()->findAllBySql('select H.CDHorario,H.NMHorario from Horario H,Turma T where T.CDTurno = H.CDTurno and T.CDTurma='.$turma.' and H.NMHorario > \''.$marcacao.'\' ORDER BY H.NMHorario');
	    $data=CHtml::listData($data,'CDHorario','NMHorario');
	    foreach($data as $value=>$name)
	    {
	        echo CHtml::tag('option',
	                   array('value'=>$value),CHtml::encode($name),true);
	    }

	}

	/**
	 * Displays a particular model.
	 */
	public function actionView($id)
	{
		if(isset($_GET['userUrl'])){
			$userUrl = 'adminHistorico';
		}
		else{
			$userUrl = 'admin?marcada=true';
		}
		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$id);
		$model = PAMarcacaoProva::model()->find($criteria);

		$modelAv = PAAvaliacao::model()->findbyPk($id);

		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$id);
		$modelPA = PAPlanoAvaliacao::model()->find($criteria);

		$modelP = PAPlanoEtapa::model()->findbyPk($modelPA->id_plano);

		$this->render('view',array(
			'model'=>$model,
			'modelAv'=>$modelAv,
			'modelP'=>$modelP,
			'userUrl'=>$userUrl
		));
	}

	public function actionCreate($id)
	{
		$model=new PAMarcacaoProva;
		$modelAv = PAAvaliacao::model()->findbyPk($id);

		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$id);
		$modelPA = PAPlanoAvaliacao::model()->find($criteria);

		$modelP = PAPlanoEtapa::model()->findbyPk($modelPA->id_plano);
		// Uncomment the following line if AJAX validation is needed
	    $this->performAjaxValidation($model);

		if(isset($_POST['PAMarcacaoProva']))
		{
			$model->attributes=$_POST['PAMarcacaoProva'];
			$model->id_avaliacao = $id;
			$model->CDTurma = $modelP->turma;
			$model->CDDisciplina = $modelP->disciplina;
			if($model->save()){
				$modelAv->marcada = 1;
				$modelAv->save();
				$this->redirect(array('//PAAvaliacao/admin','marcada'=>'true','success'=>'true'));
			}
		}
		$this->render('create',array(
			'model'=>$model,
			'modelAv'=>$modelAv,
			'modelP'=>$modelP,
		));
	}

	public function actionUpdate($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$id);
		$model = PAMarcacaoProva::model()->find($criteria);

		$modelAv = PAAvaliacao::model()->findbyPk($id);

		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$id);
		$modelPA = PAPlanoAvaliacao::model()->find($criteria);

		$modelP = PAPlanoEtapa::model()->findbyPk($modelPA->id_plano);
		// Uncomment the following line if AJAX validation is needed
	    $this->performAjaxValidation($model);

		if(isset($_POST['PAMarcacaoProva']))
		{
			$model->attributes=$_POST['PAMarcacaoProva'];
			$model->id_avaliacao = $id;
			$model->CDTurma = $modelP->turma;
			$model->CDDisciplina = $modelP->disciplina;
			if($model->save()){
				$modelAv->marcada = 1;
				$modelAv->save();
				$this->redirect(array('//PAAvaliacao/admin','marcada'=>'true','success'=>'true'));
			}
		}
		else{
			$DataProva= $model->data;
			$ar = explode('-', $DataProva);
			$model->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
		}
		$this->render('create',array(
			'model'=>$model,
			'modelAv'=>$modelAv,
			'modelP'=>$modelP,
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
			$modelProva=new Prova;
			$modelProva = $this->loadModel()->relProva;
			$this->loadModel()->delete();
			$modelProva->delete();


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
		$dataProvider=new CActiveDataProvider('MarcacaoProva');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout='//layouts/column1';
		$model=new MarcacaoProva('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MarcacaoProva']))
			$model->attributes=$_GET['MarcacaoProva'];
			
		// para tamanho da página selecionada no gridview	
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}



		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionAdminHistorico()
	{
		$this->layout='//layouts/column1';
		$model=new MarcacaoProva('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MarcacaoProva']))
			$model->attributes=$_GET['MarcacaoProva'];
			
		// para tamanho da página selecionada no gridview	
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}


		$this->render('adminHistorico',array(
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
				$this->_model=PAMarcacaoProva::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	public function actionViewM()
	{
		$this->renderPartial('viewM',array(
			'model'=>$this->loadModel(),
		),false,false);
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='marcacao-prova-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionProvaHistorico(){
		$idAv = $_GET['idAv'];
		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$idAv);
		$criteria->compare('data','>='.date('Y-m-d'));
		$model = PAMarcacaoProva::model()->find($criteria);

		$criteria = new CDbCriteria();
		$criteria->compare('id_avaliacao',$idAv);
		$model2 = PAMarcacaoProva::model()->find($criteria);
		$valor = 0;
		if(is_null($model)){
			if(!is_null($model2))
				$valor = 0;
			else{
				$valor = 1;
			}
		}
		else
			$valor = 1;
			echo $valor;
		
	}
}
