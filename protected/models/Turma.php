<?php

/**
 * This is the model class for table "Turma".
 *
 * The followings are the available columns in table 'Turma':
 * @property integer $CDTurma
 * @property string $NMTurma
 * @property integer $CDModalidade
 */
class Turma extends CActiveRecord
{
	
	
	public $modalidadeNMModalidade;
	public $turnoNMTurno;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Turma the static model class
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
		return 'Turma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMTurma, CDModalidade, CDTurno', 'required'),
			array('CDModalidade, CDTurno', 'numerical', 'integerOnly'=>true),
			array('NMTurma', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDTurma, NMTurma, modalidadeNMModalidade, turnoNMTurno', 'safe', 'on'=>'search'),
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
			'relModalidade' => array(self::BELONGS_TO, 'Modalidade', 'CDModalidade'),
			'relTurno' => array(self::BELONGS_TO, 'Turno', 'CDTurno'),
			'relTurmaDisciplina' => array(self::MANY_MANY, 'Disciplina', 'TurmaDisciplina(CDTurma, CDDisciplina)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDTurma' => 'Código',
			'NMTurma' => 'Turma',
			'relModalidade.NMModalidade' => 'Modalidade',
			'relTurno.NMTurno' => 'Turno',
			'CDModalidade' => 'Modalidade',
			'CDTurno' => 'Turno',
			'relTurmaDisciplina' => 'Disciplinas escolhidas',
			'relTurmaDisciplina2' => 'Disciplinas disponíveis',
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
		
		$criteria->with = array('relModalidade','relTurno');
		
		$criteria->together = true;

		$criteria->compare('CDTurma',$this->CDTurma);

		$criteria->compare('NMTurma',$this->NMTurma,true);

		$criteria->compare('CDModalidade',$this->CDModalidade);
		
		$criteria->compare('relModalidade.NMModalidade',$this->modalidadeNMModalidade, true);
		
		$criteria->compare('relTurno.NMTurno',$this->turnoNMTurno, true);
		
		$criteria->order = 'NMTurma';

		return new CActiveDataProvider('Turma', array(
			'criteria'=>$criteria,
		));
	}
	
	// Método adicionado junto com a extensão CAdvancedArBehavior
	public function behaviors(){
	          return array( 'CAdvancedArBehavior' => array(
	            'class' => 'application.extensions.CAdvancedArBehavior'));
	}
	
	/////

}

