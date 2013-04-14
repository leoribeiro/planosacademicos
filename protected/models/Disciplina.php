<?php

/**
 * This is the model class for table "disciplina".
 *
 * The followings are the available columns in table 'disciplina':
 * @property integer $CDDisciplina
 * @property string $NMDisciplina
 */
class Disciplina extends CActiveRecord
{
	
	public $coordenacaoNMCoordenacao;
	/**
	 * Returns the static model of the specified AR class.
	 * @return disciplina the static model class
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
		return 'Disciplina';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMDisciplina, SGDisciplina, CDCoordenacao', 'required'),
			array('NMDisciplina', 'length', 'max'=>80),
			array('SGDisciplina', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDDisciplina, NMDisciplina, SGDisciplina, coordenacaoNMCoordenacao', 'safe', 'on'=>'search'),
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
			'relCoordenacao' => array(self::BELONGS_TO, 'Coordenacao', 'CDCoordenacao'),
			'relTurmaDisciplina' => array(self::MANY_MANY, 'Turma', 'TurmaDisciplina(CDTurma, CDDisciplina)'),
			'relProfessorSubstitutoDisciplina' => array(self::MANY_MANY, 'ProfessorSubstituto', 'ProfessorSubstitutoDisciplina(ProfessorSubstituto_CDProfessorSubstituto, Disciplina_CDDisciplina)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDDisciplina' => 'Código',
			'NMDisciplina' => 'Nome',
			'SGDisciplina' => 'Sigla',
			'relCoordenacao.NMCoordenacao' => 'Coordenação',

		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('relCoordenacao');
		
		$criteria->together = true;

		$criteria->compare('CDDisciplina',$this->CDDisciplina);

		$criteria->compare('NMDisciplina',$this->NMDisciplina,true);
		
		$criteria->compare('SGDisciplina',$this->SGDisciplina,true);

		$criteria->compare('relCoordenacao.NMCoordenacao',$this->coordenacaoNMCoordenacao,true);
		
		$criteria->order = 'NMDisciplina';

		return new CActiveDataProvider('Disciplina', array(
			'criteria'=>$criteria,
		));
	}
}