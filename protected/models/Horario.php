<?php

/**
 * This is the model class for table "Horario".
 *
 * The followings are the available columns in table 'Horario':
 * @property integer $CDHorario
 * @property string $NMHorario
 * @property integer $CDTurno
 */
class Horario extends CActiveRecord
{
	
	public $turnoNMTurno;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Horario the static model class
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
		return 'Horario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMHorario, CDTurno', 'required'),
			array('CDTurno', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDHorario, NMHorario, turnoNMTurno', 'safe', 'on'=>'search'),
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
			'relTurno' => array(self::BELONGS_TO, 'Turno', 'CDTurno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDHorario' => 'Código',
			'NMHorario' => 'Horário',
			'relTurno.NMTurno' => 'Turno',
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
		
		$criteria->with = array('relTurno');
		
		$criteria->together = true;

		$criteria->compare('CDHorario',$this->CDHorario);

		$criteria->compare('NMHorario',$this->NMHorario,true);

		$criteria->compare('CDTurno',$this->CDTurno);
		
		$criteria->compare('relTurno.NMTurno',$this->turnoNMTurno, true);

		$criteria->order = 'NMHorario';
		
		return new CActiveDataProvider('Horario', array(
			'criteria'=>$criteria,
		));
	}
}