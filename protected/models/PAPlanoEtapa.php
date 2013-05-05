<?php

/**
 * This is the model class for table "PA_PlanoEtapa".
 *
 * The followings are the available columns in table 'PA_PlanoEtapa':
 * @property integer $id
 * @property integer $bimestre
 * @property integer $ano
 * @property integer $professor
 * @property integer $turma
 * @property integer $disciplina
 */
class PAPlanoEtapa extends CActiveRecord
{

	public $servidorNMServidor;
	public $turmaNMTurma;
	public $discNMDisc;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PAPlanoEtapa the static model class
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
		return 'PA_PlanoEtapa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ano, professor, turma, disciplina', 'required'),
			array('ano, professor, turma, disciplina', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ano, professor, turma, disciplina', 'safe', 'on'=>'search'),
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
			'relAulas' => array(self::BELONGS_TO, 'PAPlanoAula', 'id_plano'),
			'relAvaliacoes' => array(self::BELONGS_TO, 'PAPlanoAvaliacao', 'id_plano'),
			'relProfessor' => array(self::BELONGS_TO, 'Professor', 'professor'),
			'relDisciplina' => array(self::BELONGS_TO, 'Disciplina', 'disciplina'),
			'relTurma' => array(self::BELONGS_TO, 'Turma', 'turma'),
			'relPA' => array(self::HAS_MANY, 'PAPlanoAvaliacao', 'id_plano'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ano' => 'Ano letivo',
			'professor' => 'Professor',
			'turma' => 'Turma',
			'disciplina' => 'Disciplina',
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
		$parametros = func_get_args();

		$criteria=new CDbCriteria;

		$criteria->with = array('relProfessor.relServidor','relProfessor','relTurma','relDisciplina');
		$criteria->together = true;

		$criteria->compare('id',$this->id);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('professor',$this->professor);

		if(isset($parametros[0]) && Yii::app()->user->name != "admin"){
			$criteriaA = new CDbCriteria();
			$criteriaA->compare('Servidor_CDServidor',Yii::app()->user->CDServidor);
			$modelAux = Professor::model()->with('relServidor')->find($criteriaA);
			$criteria->compare('professor',$modelAux->CDProfessor);
		}

		$criteria->compare('relProfessor.relServidor.NMServidor',$this->servidorNMServidor,true);

		$criteria->compare('turma',$this->turma);

		$criteria->compare('relTurma.NMTurma',$this->turmaNMTurma,true);

		$criteria->compare('disciplina',$this->disciplina);

		$criteria->compare('relDisciplina.NMDisciplina',$this->discNMDisc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//
	// Once EJsonBehavior is placed in the folder
	// We need to configure the behavior() function
	// in your model

	public function behaviors() {
	   return array(
	     'EJsonBehavior'=>array(
	    'class'=>'application.behaviors.EJsonBehavior'
	      ),
	    );
	}
}