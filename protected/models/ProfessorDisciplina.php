<?php

/**
 * This is the model class for table "professor_disciplina".
 *
 * The followings are the available columns in table 'professor_disciplina':
 * @property integer $id
 * @property integer $id_professor
 * @property integer $id_disciplina
 *
 * The followings are the available model relations:
 * @property Disciplina $idDisciplina
 * @property Professor $idProfessor
 */
class ProfessorDisciplina extends CActiveRecord
{
	public $disciplinas;
	public $professor;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfessorDisciplina the static model class
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
		return 'professor_disciplina';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_professor, id_disciplina', 'required'),
			array('id_professor, id_disciplina', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_professor, id_disciplina', 'safe', 'on'=>'search'),
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
			'relDisciplina' => array(self::BELONGS_TO, 'Disciplina', 'id_disciplina'),
			'relProfessor' => array(self::BELONGS_TO, 'Professor', 'id_professor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_professor' => 'Id Professor',
			'id_disciplina' => 'Id Disciplina',
		);
	}

	public function getDisciplinas(){
		 $criteria = new CDbCriteria();
		 $criteria->compare('id_professor',$this->id_professor);
		 $modelP = ProfessorDisciplina::model()->findAll($criteria);
		 
		 if(empty($modelP)){
		 	$this->disciplinas = "Sem Disciplinas";
		 }
		 else {
		 	$idsDisc = array();
		 	foreach($modelP as $m){
		 		$idsDisc[] = $m->id_disciplina;
		 	}
		 	$criteria = new CDbCriteria();
		 	$criteria->addInCondition('id',$idsDisc);
		 	$modelD = Disciplina::model()->findAll($criteria);
		 	$disc = "";
		 	foreach($modelD as $m){
		 		$disc .= $m->NMDisciplina . ",";
		 	}
		 	rtrim($disc, ",");
		 	$this->disciplinas = $disc;
		 }
         return $this->disciplinas;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_professor',$this->id_professor);
		$criteria->compare('id_disciplina',$this->id_disciplina);

		$criteria->distinct = true;
        $criteria->select = 'id_professor';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}