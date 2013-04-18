<?php

/**
 * This is the model class for table "MarcacaoProva".
 *
 * The followings are the available columns in table 'MarcacaoProva':
 * @property integer $CDMarcacao
 * @property integer $CDDisciplina
 * @property integer $CDTurma
 * @property integer $CDProva
 * @property integer $CDProfessor
 * @property string $DATA
 * @property string $INICIO
 * @property string $FIM
 * @property string $DataProvaMarcada
 */
class PAMarcacaoProva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MarcacaoProva the static model class
	 */
	
	
	// atributos usados para FK
	public $disciplinaNMDisciplina;
	public $turmaNMTurma;
	public $professorNMProfessor;
	public $provaNMProva;
	public $horarioINICIO;
	public $horarioFIM;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PA_MarcacaoProva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CDTipoTurma, data, inicio, fim, conteudo', 'required'),
			array('CDTipoTurma, inicio, fim', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('data', 'date','format'=>'dd/MM/yyyy'),
			array(' data', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(

			'relTipoTurma' => array(self::BELONGS_TO, 'TipoTurma', 'CDTipoTurma'),
			'relHorarioInicio' => array(self::BELONGS_TO, 'Horario', 'inicio'),
			'relHorarioFim' => array(self::BELONGS_TO, 'Horario', 'fim'),
			'relAvaliacao' => array(self::BELONGS_TO, 'PAAvaliacao', 'id_avaliacao'),
			'relDisciplina' => array(self::BELONGS_TO, 'Disciplina', 'CDDisciplina'),
			'relProva' => array(self::BELONGS_TO, 'Prova', 'CDProva'),
			'relTurma' => array(self::BELONGS_TO, 'Turma', 'CDTurma'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDMarcacao' => 'Código da Prova',
			'inicio' => 'Início',
			'fim' => 'Término',
			'data' => 'Data da Prova',
			'relHorarioInicio.NMHorario' => 'Início',
			'relHorarioFim.NMHorario' => 'Término',
			'DataProvaMarcada' => 'Data de marcação da prova',
			'relTipoTurma.CDTipoTurma' => 'Tipo da turma',
			'CDTipoTurma' => 'Tipo da Turma',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		$criteria=new CDbCriteria;

		$criteria->with = array('relDisciplina','relTurma','relProfessor',
		'relHorarioInicio','relProva','relHorarioFim','relProfessor.relServidor');
		$criteria->together = true;

		$criteria->compare('CDMarcacao',$this->CDMarcacao);

		// if($this->data != ''){
		// 	$DataProva= $this->data;
		// 	$ar = explode('/', $DataProva);
		// 	if(count($ar) == 3)
		// 		$this->data = $ar[2].'-'.$ar[1].'-'.$ar[0];
	 //    }

		$criteria->compare('data',$this->data,true);

		// if($this->data != ''){
		// 	$DataProva= $this->data;
		// 	$ar = explode('-', $DataProva);
		// 	if(count($ar) == 3)
		// 		$this->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
	 //    }

		$criteria->compare('inicio',$this->inicio,true);

		$criteria->compare('fim',$this->fim,true);

		$criteria->compare('DataProvaMarcada',$this->dataProvaMarcada,true);

		$criteria->compare('relHorarioInicio.NMHorario',$this->horarioINICIO, true);

		$criteria->compare('relHorarioFim.NMHorario',$this->horarioFIM, true);

		return new CActiveDataProvider('MarcacaoProva', array(
			'pagination'=>array(
			      'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}

				/*
	Função para subtrair datas em dias
	Data no formato Y-m-d
	*/
	function dtSubtrair($data,$dias) {
		$data = str_replace("-","",$data);
		$ano = substr ( $data, 0, 4 );
		$mes = substr ( $data, 4, 2 );
		$dia = substr ( $data, 6, 2 );
		$novaData = mktime ( 0, 0, 0, $mes, $dia - $dias, $ano );
		return strftime("%Y-%m-%d", $novaData);
	}

		/*
	Função para somar datas em dias
	Data no formato Y-m-d
	*/
	function dtSomar($data,$dias) {
		$data = str_replace("-","",$data);
		$ano = substr ( $data, 0, 4 );
		$mes = substr ( $data, 4, 2 );
		$dia = substr ( $data, 6, 2 );
		$novaData = mktime ( 0, 0, 0, $mes, $dia + $dias, $ano );
		return strftime("%Y-%m-%d", $novaData);
	}

	public function beforeSave() {


			// Coloca a data no formato do BD
			if($this->data != ''){
				$DataProva= $this->data;
				$ar = explode('/', $DataProva);
				$this->data = $ar[2].'-'.$ar[1].'-'.$ar[0];
			}
			if((strtotime($this->data) <= strtotime('+6 days',strtotime(date('Y-m-d')))) and
			!(Yii::app()->user->name == 'admin')){
				 $this->addError('data','Não é possível marcar prova neste dia. Deve-se ter ao menos uma semana de antecedência para marcação da prova.');
				 $DataProva= $this->data;
			     $ar = explode('-', $DataProva);
			     $this->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
				 return false;
			}

			// verifica quantidade de provas por semana
			$data = strtotime($this->data);
			$w = date("w",$data);
			$dtant = $this->dtSubtrair($this->data,$w)."<br>";
			$dtdep = $this->dtSomar($this->data,6-$w)."<br>";
			if(isset($this->CDMarcacao)){
		     	$lista = PAMarcacaoProva::model()->findAll(array(
				    'select'=>'CDMarcacao,data',
				    'condition'=>'data BETWEEN :DATAINICIAL AND :DATAFINAL AND CDTurma=:TURMAREGISTRO AND CDMarcacao!=:CDMARC',
				    'params'=>array(':DATAINICIAL'=>$dtant,':DATAFINAL'=>$dtdep,':TURMAREGISTRO'=>$this->CDTurma,':CDMARC'=>$this->CDMarcacao),
				));
			}
			else {
		     	$lista = PAMarcacaoProva::model()->findAll(array(
				    'select'=>'CDMarcacao,data',
				    'condition'=>'data BETWEEN :DATAINICIAL AND :DATAFINAL AND CDTurma=:TURMAREGISTRO',
				    'params'=>array(':DATAINICIAL'=>$dtant,':DATAFINAL'=>$dtdep,':TURMAREGISTRO'=>$this->CDTurma),
				));
			}
			if(!is_null($lista)){
				$count = count ($lista);
				if(($count >= 10) and
				!(Yii::app()->user->name == 'admin')){
					 $this->addError('data','Já existem dez provas marcadas nesta semana. Por favor escolha outra.');
					 $DataProva= $this->data;
				     $ar = explode('-', $DataProva);
				     $this->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
					 return false;
				}
			}

			// verifica quantidade de provas marcadas por dia
			if(isset($this->CDMarcacao)){
		     	$lista = PAMarcacaoProva::model()->findAll(array(
				    'select'=>'CDMarcacao,data,CDTipoTurma',
				    'condition'=>'data=:DATAREGISTRO AND CDTurma=:TURMAREGISTRO AND CDMarcacao!=:CDMARC',
				    'params'=>array(':DATAREGISTRO'=>$this->data,':TURMAREGISTRO'=>$this->CDTurma,':CDMARC'=>$this->CDMarcacao),
				));
			}
			else {
		     	$lista = PAMarcacaoProva::model()->findAll(array(
				    'select'=>'CDMarcacao,data,CDTipoTurma',
				    'condition'=>'DATA=:DATAREGISTRO AND CDTurma=:TURMAREGISTRO',
				    'params'=>array(':DATAREGISTRO'=>$this->data,':TURMAREGISTRO'=>$this->CDTurma),
				));
			}


			if(!is_null($lista)){
				$count = count ($lista);
				$countTurmaCheia = 0;
				$countTurmaT1 = 0;
				$countTurmaT2 = 0;
				foreach($lista as $registro){
					if($registro->CDTipoTurma == 1)
						$countTurmaCheia++;
					if($registro->CDTipoTurma == 2)
						$countTurmaT1++;
					if($registro->CDTipoTurma == 3)
						$countTurmaT2++;
				}
				// muito bagunçado, é necessário melhorar isso
				if((($countTurmaCheia >=1 and !($countTurmaT1 == 0 or $countTurmaT2 ==0)) or 
				($this->CDTipoTurma == 2 and $countTurmaT1 >= 1 and $countTurmaCheia >= 1) or 
				($this->CDTipoTurma == 3 and $countTurmaT2 >= 1 and $countTurmaCheia >= 1) or 
				($countTurmaT1+$countTurmaT2 >= 4) or 
				($countTurmaT1 >= 2 and $this->CDTipoTurma == 2) or 
				($countTurmaT2 >= 2 and $this->CDTipoTurma == 3) or 
				($this->CDTipoTurma == 1 and ($countTurmaT1 >= 2 or $countTurmaT2 >= 2)) or
				($this->CDTipoTurma == 1 and ($countTurmaCheia >=1 and ($countTurmaT1 >= 1 or $countTurmaT2 >= 1))) or
				($countTurmaCheia >= 2)) and
				!(Yii::app()->user->name == 'admin')){
					 $this->addError('data','Já existem duas provas marcadas neste dia. Por favor escolha outro.');
					 $DataProva= $this->data;
				     $ar = explode('-', $DataProva);
				     $this->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
					 return false;
				}
			}
			if(isset($this->CDMarcacao)){
				$lista2 = PAMarcacaoProva::model()->findAll(array(
			    'select'=>'CDMarcacao,data,CDDisciplina,CDTipoTurma',
			    'condition'=>'DATA=:DATAREGISTRO AND CDTurma=:TURMAREGISTRO AND CDDisciplina=:DISCIPLINAD AND CDMarcacao!=:CDMARC',
                	'params'=>array(':DATAREGISTRO'=>$this->data,':TURMAREGISTRO'=>$this->CDTurma,':DISCIPLINAD'=>$this->CDDisciplina,':CDMARC'=>$this->CDMarcacao),
			));
		    }
			else {
				$lista2 = PAMarcacaoProva::model()->findAll(array(
				    'select'=>'CDMarcacao,DATA,CDDisciplina,CDTipoTurma',
				    'condition'=>'DATA=:DATAREGISTRO AND CDTurma=:TURMAREGISTRO AND CDDisciplina=:DISCIPLINAD',
	                	'params'=>array(':DATAREGISTRO'=>$this->data,':TURMAREGISTRO'=>$this->CDTurma,':DISCIPLINAD'=>$this->CDDisciplina),
				));
			}
			if(!is_null($lista2)){
				$count = count ($lista2);
				$countTurmaCheia = 0;
				$countTurmaT1 = 0;
				$countTurmaT2 = 0;
				foreach($lista2 as $registro){
					if($registro->CDTipoTurma == 1)
						$countTurmaCheia++;
					if($registro->CDTipoTurma == 2)
						$countTurmaT1++;
					if($registro->CDTipoTurma == 3)
						$countTurmaT2++;
				}
				if(($count >= 1 and !(($this->CDTipoTurma == 2 and $countTurmaT2 >= 1) or ($this->CDTipoTurma == 3 and $countTurmaT1 >= 1))) or (($this->CDTipoTurma == 2 and $countTurmaT1 >= 1) or ($this->CDTipoTurma == 3 and $countTurmaT2 >= 1))){
					 $this->addError('CDDisciplina','Já existe uma prova desta disciplina nesta data.');
					 $DataProva= $this->data;
				     $ar = explode('-', $DataProva);
				     $this->data = $ar[2].'/'.$ar[1].'/'.$ar[0];
					 return false;
				}
			}
			return parent::beforeSave();


	 }

	// public function behaviors()
	// {
	//     return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'));
	// }

}