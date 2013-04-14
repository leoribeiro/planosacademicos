<?php

/**
 * This is the model class for table "TipoTurma".
 *
 * The followings are the available columns in table 'TipoTurma':
 * @property integer $CDTipoTurma
 * @property string $NMTipoTurma
 */
class TipoTurma extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TipoTurma the static model class
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
		return 'TipoTurma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMTipoTurma', 'required'),
			array('NMTipoTurma', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDTipoTurma, NMTipoTurma', 'safe', 'on'=>'search'),
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
			'marcacaoProvas' => array(self::HAS_MANY, 'MarcacaoProva', 'CDTipoTurma'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDTipoTurma' => 'Tipo da turma',
			'NMTipoTurma' => 'Qual turma',
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

		$criteria->compare('CDTipoTurma',$this->CDTipoTurma);

		$criteria->compare('NMTipoTurma',$this->NMTipoTurma,true);

		return new CActiveDataProvider('TipoTurma', array(
			'criteria'=>$criteria,
		));
	}
}