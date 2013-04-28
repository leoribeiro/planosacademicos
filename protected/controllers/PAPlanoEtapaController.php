<?php

class PAPlanoEtapaController extends Controller
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
				'actions'=>array('index','view','planos'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','aula','listaPlanos','getPlano'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','atualizaDisciplinas'),
				//'users'=>array('admin'),
				'roles'=>array('professor'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','atualizaDisciplinas'),
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
		if(isset($_GET['userUrl'])){
			$userUrl = 'planos';
		}
		else{
			$userUrl = 'admin';
		}
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$dataAulabim = array();
		$conteudoAulabim = array();
		$materialAulabim = array();
		$idAvbim = array();
		$nomeAvbim = array();
		$valorAvbim = array();
		$bimAula = array();
		$bimAv = array();

		for($x=1;$x<5;$x++){
			 $aulas = $this->carregaAulas($id,$x);
			 if(!is_null($aulas)){
			 	$d = array(); $c = array(); $m = array();
				foreach($aulas as $aula){
					$d[] = $aula->aulas;
					$c[] = $aula->conteudo;
					$m[] = $aula->material;
				}
				$dataAulabim[] = $d;
				$conteudoAulabim[] = $c;
				$materialAulabim[] = $m;
				$bimAula[] = $x;
			}
		}

		for($x=1;$x<5;$x++){
			$avs = $this->carregaAvaliacoes($id,$x);
			if(!is_null($avs)){
				$d = array(); $c = array(); $m = array(); $t = array();
				foreach($avs as $av){
					$t[] = $av->id;
					$d[] = $av->descricao;
					$c[] = $av->valor;
				}
				$idAvbim[] = $t;
				$nomeAvbim[] = $d;
				$valorAvbim[] = $c;
				$bimAv[] = $x;
			}

		}
		$aulas = array();
		$aulas[] = $dataAulabim;
		$aulas[] = $conteudoAulabim;
		$aulas[] = $materialAulabim;
		$aulas[] = $bimAula;
		$avs = array();
		$avs[] = $nomeAvbim;
		$avs[] = $valorAvbim;
		$avs[] = $bimAv;
		$avs[] = $idAvbim;
		$this->render('view',array(
			'model'=>$model,'aulas'=>$aulas,'avs'=>$avs,'userUrl'=>$userUrl
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PAPlanoEtapa;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$dataAulabim = array();
		$conteudoAulabim = array();
		$materialAulabim = array();
		$nomeAvbim = array();
		$valorAvbim = array();
		$bimAula = array();
		$bimAv = array();

		if(isset($_POST['PAPlanoEtapa']))
		{
			// echo "<pre>";
			// print_r($_POST);
			// echo "</pre>";
			//exit();
			$model->attributes=$_POST['PAPlanoEtapa'];

			if(!isset($_POST['PAPlanoEtapa']['turma'])){
				$dataProf = explode("-",$model->disciplina);
				$model->disciplina = $dataProf[0];
				$model->turma = $dataProf[1];
			}

			for($x=1;$x<5;$x++){
				if(isset($_POST['dataAula'.$x.'bim'])){
					$dataAulabim[] = $_POST['dataAula'.$x.'bim'];
					$conteudoAulabim[] = $_POST['conteudoAula'.$x.'bim'];
					$materialAulabim[] = $_POST['materialAula'.$x.'bim'];
					$bimAula[] = $x;
				}
				if(isset($_POST['nomeAv'.$x.'bim'])){
					$nomeAvbim[] = $_POST['nomeAv'.$x.'bim'];
					$valorAvbim[] = $_POST['valorAv'.$x.'bim'];
					$bimAv[] = $x;
				}
			}
			if($model->validate()){

				if(empty($dataAulabim) && empty($nomeAvbim)){
					$model->addError('id','Deve-se preencher alguma etapa');
				}
				else{
					$model->save();

					$idsPlanosAula = array();
					$bimAulaN = array();
					for($x=0;$x<count($dataAulabim);$x++){
						for($y=0;$y<count($dataAulabim[$x]);$y++){
							$mPA = new PAAula;
							$mPA->aulas = $dataAulabim[$x][$y];
							$mPA->conteudo = $conteudoAulabim[$x][$y];
							$mPA->material = $materialAulabim[$x][$y];
							$mPA->save();
							$idsPlanosAula[] = $mPA->id;
							$bimAulaN[] = $bimAula[$x];
						}
					}
					$idsAv = array();
					$bimAvN = array();
					for($x=0;$x<count($nomeAvbim);$x++){
						for($y=0;$y<count($nomeAvbim[$x]);$y++){
							$mPA = new PAAvaliacao;
							$mPA->descricao = $nomeAvbim[$x][$y];
							$mPA->valor = $valorAvbim[$x][$y];
							$mPA->save();
							$idsAv[] = $mPA->id;
							$bimAvN[] = $bimAv[$x];
						}
					}
					for($x=0;$x<count($idsPlanosAula);$x++){
						$mPPA = new PAPlanoAula;
						$mPPA->id_plano = $model->id;
						$mPPA->id_aula = $idsPlanosAula[$x];
						$mPPA->bimestre = $bimAulaN[$x];
						$mPPA->save();
					}
					for($x=0;$x<count($idsAv);$x++){
						$mPPA = new PAPlanoAvaliacao;
						$mPPA->id_plano = $model->id;
						$mPPA->id_avaliacao = $idsAv[$x];
						$mPPA->bimestre = $bimAvN[$x];
						$mPPA->save();
					}
					$this->redirect(array('admin','success'=>true));
				}
			}

		}

		$aulas = array();
		$aulas[] = $dataAulabim;
		$aulas[] = $conteudoAulabim;
		$aulas[] = $materialAulabim;
		$aulas[] = $bimAula;
		$avs = array();
		$avs[] = $nomeAvbim;
		$avs[] = $valorAvbim;
		$avs[] = $bimAv;
		$this->render('create',array(
			'model'=>$model,'aulas'=>$aulas,'avs'=>$avs
		));
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

		$dataAulabim = array();
		$conteudoAulabim = array();
		$materialAulabim = array();
		$idAvbim = array();
		$nomeAvbim = array();
		$valorAvbim = array();
		$bimAula = array();
		$bimAv = array();

		for($x=1;$x<5;$x++){
			 $aulas = $this->carregaAulas($id,$x);
			 if(!is_null($aulas)){
			 	$d = array(); $c = array(); $m = array();
				foreach($aulas as $aula){
					$d[] = $aula->aulas;
					$c[] = $aula->conteudo;
					$m[] = $aula->material;
				}
				$dataAulabim[] = $d;
				$conteudoAulabim[] = $c;
				$materialAulabim[] = $m;
				$bimAula[] = $x;
			}
		}

		for($x=1;$x<5;$x++){
			$avs = $this->carregaAvaliacoes($id,$x);
			if(!is_null($avs)){
				$d = array(); $c = array(); $m = array(); $t = array();
				foreach($avs as $av){
					$t[] = $av->id;
					$d[] = $av->descricao;
					$c[] = $av->valor;
				}
				$idAvbim[] = $t;
				$nomeAvbim[] = $d;
				$valorAvbim[] = $c;
				$bimAv[] = $x;
			}

		}

		if(isset($_POST['PAPlanoEtapa']))
		{
			// limpa variaveis
			$dataAulabim = array();
			$conteudoAulabim = array();
			$materialAulabim = array();
			$idAvbim = array();
			$nomeAvbim = array();
			$valorAvbim = array();
			$bimAula = array();
			$bimAv = array();

			$model->attributes=$_POST['PAPlanoEtapa'];

			if(!isset($_POST['PAPlanoEtapa']['turma'])){
				$dataProf = explode("-",$model->disciplina);
				$model->disciplina = $dataProf[0];
				$model->turma = $dataProf[1];
			}

			for($x=1;$x<5;$x++){
				if(isset($_POST['dataAula'.$x.'bim'])){
					$dataAulabim[] = $_POST['dataAula'.$x.'bim'];
					$conteudoAulabim[] = $_POST['conteudoAula'.$x.'bim'];
					$materialAulabim[] = $_POST['materialAula'.$x.'bim'];
					$bimAula[] = $x;
				}
				if(isset($_POST['nomeAv'.$x.'bim'])){
					$idAvbim[] = $_POST['idAv'.$x.'bim'];
					$nomeAvbim[] = $_POST['nomeAv'.$x.'bim'];
					$valorAvbim[] = $_POST['valorAv'.$x.'bim'];
					$bimAv[] = $x;
				}
			}
			if($model->validate()){

				if(empty($dataAulabim) && empty($nomeAvbim)){
					$model->addError('id','Deve-se preencher alguma etapa');
				}
				else{
					$model->save();

					$marcadas = $this->carregaAvaliacoesMarcadas($id);

					$this->deletarDependecias($model->id);

					$idsPlanosAula = array();
					$bimAulaN = array();
					for($x=0;$x<count($dataAulabim);$x++){
						for($y=0;$y<count($dataAulabim[$x]);$y++){
							$mPA = new PAAula;
							$mPA->aulas = $dataAulabim[$x][$y];
							$mPA->conteudo = $conteudoAulabim[$x][$y];
							$mPA->material = $materialAulabim[$x][$y];
							$mPA->save();
							$idsPlanosAula[] = $mPA->id;
							$bimAulaN[] = $bimAula[$x];
						}
					}
					$idsAv = array();
					$bimAvN = array();
					for($x=0;$x<count($nomeAvbim);$x++){
						for($y=0;$y<count($nomeAvbim[$x]);$y++){
							$mPA = new PAAvaliacao;
							$mPA->descricao = $nomeAvbim[$x][$y];
							$mPA->valor = $valorAvbim[$x][$y];
							$mPA->save();
							$idsAv[] = $mPA->id;
							$bimAvN[] = $bimAv[$x];
							if($idAvbim[$x][$y] != 0){

								$idAv = $idAvbim[$x][$y];
								for($r=0;$r<count($marcadas);$r++){
									if($idAv == $marcadas[$r][5]){
										$marcadas[$r][5] = $mPA->id;
										$marcadas[$r][9] = 1;
										$mPAupdate = PAAvaliacao::model()->findByPk($mPA->id);
										$mPAupdate->marcada = 1;
										$mPAupdate->save();
										break;
									}
								}
							}
						}
					}

					// remarca as provas
					foreach($marcadas as $m){
						if($m[9] == 1){
							$a = new PAMarcacaoProva;
							$a->CDTipoTurma = $m[0];
							$DataProva= $m[1];
							$ar = explode('-', $DataProva);
							$m[1] = $ar[2].'/'.$ar[1].'/'.$ar[0];
							$a->data = $m[1];
							$a->inicio = $m[2];
							$a->fim = $m[3];
							$a->id_avaliacao = $m[5];
							$a->conteudo = $m[6];
							$a->CDTurma = $m[7];
							$a->CDDisciplina = $m[8];
							$a->save();
						}
					}
					for($x=0;$x<count($idsPlanosAula);$x++){
						$mPPA = new PAPlanoAula;
						$mPPA->id_plano = $model->id;
						$mPPA->id_aula = $idsPlanosAula[$x];
						$mPPA->bimestre = $bimAulaN[$x];
						$mPPA->save();
					}
					for($x=0;$x<count($idsAv);$x++){
						$mPPA = new PAPlanoAvaliacao;
						$mPPA->id_plano = $model->id;
						$mPPA->id_avaliacao = $idsAv[$x];
						$mPPA->bimestre = $bimAvN[$x];
						$mPPA->save();
					}
					$this->redirect(array('admin','success'=>true));
				}
			}

		}

		$aulas = array();
		$aulas[] = $dataAulabim;
		$aulas[] = $conteudoAulabim;
		$aulas[] = $materialAulabim;
		$aulas[] = $bimAula;
		$avs = array();
		$avs[] = $nomeAvbim;
		$avs[] = $valorAvbim;
		$avs[] = $bimAv;
		$avs[] = $idAvbim;
		$this->render('update',array(
			'model'=>$model,'aulas'=>$aulas,'avs'=>$avs
		));
	}

	function carregaAulas($id,$bim){

		// Aulas
		$criteria = new CDbCriteria();
		$criteria->compare('id_plano',$id);
		$criteria->compare('bimestre',$bim);
		$modelPA = PAPlanoAula::model()->findAll($criteria);
		$idsAula = array();
		foreach($modelPA as $p){
			$idsAula[] = $p->id_aula;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$idsAula);
		$modelA = PAAula::model()->findAll($criteria);

		return $modelA;

	}

	function carregaAvaliacoes($id,$bim){

		// Avaliações
		$criteria = new CDbCriteria();
		$criteria->compare('id_plano',$id);
		$criteria->compare('bimestre',$bim);
		$modelPA = PAPlanoAvaliacao::model()->findAll($criteria);
		$idsAv = array();
		foreach($modelPA as $p){
			$idsAv[] = $p->id_avaliacao;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$idsAv);
		$modelA = PAAvaliacao::model()->findAll($criteria);

		return $modelA;

	}

	function carregaAvaliacoesMarcadas($id){

		// Avaliações marcadas
		$criteria = new CDbCriteria();
		$criteria->compare('id_plano',$id);
		$modelPA = PAPlanoAvaliacao::model()->findAll($criteria);
		$idsAv = array();
		foreach($modelPA as $p){
			$idsAv[] = $p->id_avaliacao;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id_avaliacao',$idsAv);
		$modelA = PAMarcacaoProva::model()->findAll($criteria);

		$marcadas = array();
		$x = 0;
		foreach($modelA as $a){
			$marcadas[$x][] = $a->CDTipoTurma;
			$marcadas[$x][] = $a->data;
			$marcadas[$x][] = $a->inicio;
			$marcadas[$x][] = $a->fim;
			$marcadas[$x][] = $a->DataProvaMarcada;
			$marcadas[$x][] = $a->id_avaliacao;
			$marcadas[$x][] = $a->conteudo;
			$marcadas[$x][] = $a->CDTurma;
			$marcadas[$x][] = $a->CDDisciplina;
			$marcadas[$x][] = 0;
			$x++;
		}
		//if(isset(Yii::app()->session['marcadas']))
		//	unset(Yii::app()->session['marcadas']);
		//Yii::app()->session['marcadas'] = $marcadas;
		// if($x == 0)
		// 	return false;
		// return true;
		return $marcadas;

	}

	function deletarDependecias($id){

		// Aulas
		$criteria = new CDbCriteria();
		$criteria->compare('id_plano',$id);
		$modelPA = PAPlanoAula::model()->findAll($criteria);
		$idsAula = array();
		foreach($modelPA as $p){
			$idsAula[] = $p->id_aula;
		}
		$num = PAPlanoAula::model()->deleteAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$idsAula);
		$num = PAAula::model()->deleteAll($criteria);

		// Avaliacao
		$criteria = new CDbCriteria();
		$criteria->compare('id_plano',$id);
		$modelPA = PAPlanoAvaliacao::model()->findAll($criteria);
		$idsAv = array();
		foreach($modelPA as $p){
			$idsAv[] = $p->id_avaliacao;
		}
		$num = PAPlanoAvaliacao::model()->deleteAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id_avaliacao',$idsAv);
		$num = PAMarcacaoProva::model()->deleteAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$idsAv);
		$num = PAAvaliacao::model()->deleteAll($criteria);



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
			$this->deletarDependecias($id);

			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('PAPlanoEtapa');
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

			Yii::app()->user->setFlash('success', 'Plano de aula criado com sucesso!');

		}
		$model=new PAPlanoEtapa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PAPlanoEtapa']))
			$model->attributes=$_GET['PAPlanoEtapa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionPlanos()
	{
		$model=new PAPlanoEtapa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PAPlanoEtapa']))
			$model->attributes=$_GET['PAPlanoEtapa'];

		$this->render('planos',array(
			'model'=>$model,
		));
	}

	public function actionListaPlanos()
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('relDisciplina','relTurma');
		$criteria->together = true;
		if(!Yii::app()->user->name == "admin"){
			$criteriaS = new CDbCriteria();
			$criteriaS->compare('Servidor_CDServidor',Yii::app()->user->CDServidor);
			$modelAux = Professor::model()->with('relServidor')->find($criteriaS);
			$criteria->compare('professor',$modelAux->CDProfessor);
		}

		$model = PAPlanoEtapa::model()->findAll($criteria);
		$x = 0;
		foreach ($model as $m) {
        	$rows[$x] = $m->attributes;
        	$rows[$x]['disc'] = $m->relDisciplina->NMDisciplina;
        	$rows[$x]['turma'] = $m->relTurma->NMTurma;
        	$x++;
    	}

		echo CJSON::encode($rows);
	}

	public function actionGetPlano()
	{
		$id = null;
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		$criteria = new CDbCriteria;
		$criteria->compare('id_plano',$id);
		$model = PAPlanoAula::model()->findAll($criteria);
		$idsAula = array();
		$bimAula = array();
		foreach ($model as $m) {
        	$idsAula[] = $m->id_aula;
        	$bimAula[] = $m->bimestre;
    	}

    	$criteria = new CDbCriteria;
		$criteria->compare('id_plano',$id);
    	$model = PAPlanoAvaliacao::model()->findAll($criteria);
		$idsAv = array();
		$bimAv = array();
		foreach ($model as $m) {
        	$idsAv[] = $m->id_avaliacao;
        	$bimAv[] = $m->bimestre;
    	}

    	$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$idsAula);
    	$modelsAula = PAAula::model()->findAll($criteria);

    	$aulas = array();
		$x = 0;
		foreach ($modelsAula as $m) {
        	$aulas[$x] = $m->attributes;
        	$aulas[$x]["bim"] = $bimAula[$x];
        	$x++;
    	}

    	$criteria = new CDbCriteria;
		$criteria->addInCondition('id',$idsAv);
    	$modelsAv = PAAvaliacao::model()->findAll($criteria);

    	$avs = array();
    	$x = 0;
		foreach ($modelsAv as $m) {
        	$avs[$x] = $m->attributes;
        	$avs[$x]["bim"] = $bimAv[$x];
        	$x++;
    	}

    	$dados = array();
    	$dados[] = $aulas;
    	$dados[] = $avs;

		echo CJSON::encode($dados);
	}

	public function actionAula()
	{

		$this->renderPartial('_formAula');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=PAPlanoEtapa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='paplano-etapa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAtualizaDisciplinas()
	{

		if($_POST['PAPlanoEtapa']['turma'] == "")
			$turma = null;
		else
		    $turma = $_POST['PAPlanoEtapa']['turma'];
		
		if($_POST['PAPlanoEtapa']['disciplina'] == "")
			$disc = null;
		else
		    $disc = $_POST['PAPlanoEtapa']['disciplina'];
		
		$resultado = Disciplina::model()->with('relTurmaDisciplina')->findAll(
		 array('order'=>'NMDisciplina','condition'=>'relTurmaDisciplina.CDTurma=:TUR',
	    'params'=>array(':TUR'=>$turma)));
	
	    $data=CHtml::listData($resultado,'CDDisciplina','NMDisciplina');
		echo CHtml::tag('option',
	                   array('value'=>''),CHtml::encode('Selecione uma disciplina'),true);
	    foreach($data as $value=>$name)
	    {
			if($disc == $value){
				echo CHtml::tag('option',
	                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
			}
			else 
	        	echo CHtml::tag('option',
	                   array('value'=>$value),CHtml::encode($name),true);
	    }	
	
		
	}
}
