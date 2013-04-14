<?php

/**
 * This is the model class for table "Coordenacao".
 *
 * The followings are the available columns in table 'Coordenacao':
 * @property integer $CDCoordenacao
 * @property string $NMCoordenacao
 * @property integer $Departamento_CDDepartamento
 */
class Coordenacao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Coordenacao the static model class
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
		return 'Coordenacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMCoordenacao, Departamento_CDDepartamento', 'required'),
			array('Departamento_CDDepartamento', 'numerical', 'integerOnly'=>true),
			array('NMCoordenacao', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDCoordenacao, NMCoordenacao, Departamento_CDDepartamento', 'safe', 'on'=>'search'),
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
			'departamento_CDDepartamento' => array(self::BELONGS_TO, 'Departamento', 'Departamento_CDDepartamento'),
			'professors' => array(self::HAS_MANY, 'Professor', 'Coordenacao_CDCoordenacao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDCoordenacao' => 'Código',
			'NMCoordenacao' => 'Coordenação',
			'Departamento_CDDepartamento' => 'Departamento',
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

		$criteria->compare('CDCoordenacao',$this->CDCoordenacao);

		$criteria->compare('NMCoordenacao',$this->NMCoordenacao,true);

		$criteria->compare('Departamento_CDDepartamento',$this->Departamento_CDDepartamento);
		
		$criteria->order = 'NMCoordenacao';

		return new CActiveDataProvider('Coordenacao', array(
			'criteria'=>$criteria,
		));
	}
}