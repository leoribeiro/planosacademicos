<?php

/**
 * This is the model class for table "PA_Avaliacao".
 *
 * The followings are the available columns in table 'PA_Avaliacao':
 * @property integer $id
 * @property string $descricao
 * @property string $valor
 */
class PAAvaliacao extends CActiveRecord
{
	public $turma;
	public $disciplina;
	public $avMarc;
	public $data;
	public $bimestre;
	public $professor;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PAAvaliacao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PA_Avaliacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descricao, valor', 'required'),
			array('valor', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, descricao, valor', 'safe', 'on'=>'search'),
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
			'relPlanoAvaliacao' => array(self::HAS_MANY, 'PAPlanoAvaliacao', 'id_avaliacao'),
			'relMarcacaoProva' => array(self::HAS_MANY, 'PAMarcacaoProva', 'id_avaliacao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'descricao' => 'Avaliação',
			'valor' => 'Valor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($tipoPesquisa)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array('relMarcacaoProva');
		$criteria->together = true;

		$criteria->compare('id',$this->id);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('valor',$this->valor,true);

		switch($tipoPesquisa){
			case "previstas":
				$criteria->compare('marcada',0);
				break;
			case "marcadas":
				$criteria->compare('marcada',1);
				$criteria->compare('relMarcacaoProva.data','>='.date('Y-m-d'));
				break;
			case "historico":
				$criteria->compare('relMarcacaoProva.data','<'.date('Y-m-d'));
				break;
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTurma(){

		 $criteria = new CDbCriteria();
		 $criteria->with = array('relPlano','relPlano.relTurma');
		 $criteria->together = true;
		 $criteria->compare('id_avaliacao',$this->id);

		 $modelPA = PAPlanoAvaliacao::model()->find($criteria);
		 if(!isset($modelPA->relPlano->relTurma->NMTurma)){
		 	$this->turma = "Sem turma";
		 }
		 else {
		 	$this->turma = $modelPA->relPlano->relTurma->NMTurma;
		 }
         return $this->turma;
     }

     public function getDisciplina(){

		 $criteria = new CDbCriteria();
		 $criteria->with = array('relPlano','relPlano.relDisciplina');
		 $criteria->together = true;
		 $criteria->compare('id_avaliacao',$this->id);

		 $modelPA = PAPlanoAvaliacao::model()->find($criteria);
		 if(!isset($modelPA->relPlano->relDisciplina->NMDisciplina)){
		 	$this->disciplina = "Sem Disciplina";
		 }
		 else {
		 	$this->disciplina = $modelPA->relPlano->relDisciplina->NMDisciplina;
		 }
         return $this->disciplina;
     }

     public function getProfessor(){

		 $criteria = new CDbCriteria();
		 $criteria->with = array('relPlano','relPlano.relProfessor');
		 $criteria->together = true;
		 $criteria->compare('id_avaliacao',$this->id);

		 $modelPA = PAPlanoAvaliacao::model()->find($criteria);
		 if(!isset($modelPA->relPlano->relProfessor->relServidor->NMServidor)){
		 	$this->professor = "Sem Professor";
		 }
		 else {
		 	$this->professor = $modelPA->relPlano->relProfessor->relServidor->NMServidor;
		 }
         return $this->professor;
     }

     public function getData(){

		 $criteria = new CDbCriteria();
		 $criteria->compare('id_avaliacao',$this->id);

		 $modelMP = PAMarcacaoProva::model()->find($criteria);
		 if(is_null($modelMP)){
		 	$this->data = "Sem Data";
		 }
		 else {
		 	$DataProva= $modelMP->data;
			$ar = explode('-', $DataProva);
			$DataProva = $ar[2].'/'.$ar[1].'/'.$ar[0];
		 	$this->data = $DataProva;
		 }
         return $this->data;
     }

     public function getBimestre(){

		 $criteria = new CDbCriteria();
		 $criteria->compare('id_avaliacao',$this->id);

		 $modelMA = PAPlanoAvaliacao::model()->find($criteria);
		 if(is_null($modelMA)){
		 	$this->bimestre = "Sem bimestre";
		 }
		 else {
		 	$this->bimestre = $modelMA->bimestre."°";
		 }
         return $this->bimestre;
     }
}