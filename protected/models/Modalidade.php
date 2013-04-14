<?php

/**
 * This is the model class for table "Modalidade".
 *
 * The followings are the available columns in table 'Modalidade':
 * @property integer $CDModalidade
 * @property string $NMModalidade
 */
class Modalidade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Modalidade the static model class
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
		return 'Modalidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMModalidade', 'required'),
			array('NMModalidade', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDModalidade, NMModalidade', 'safe', 'on'=>'search'),
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
			'turmas' => array(self::HAS_MANY, 'Turma', 'CDModalidade'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDModalidade' => 'Código',
			'NMModalidade' => 'Nome',
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

		$criteria->compare('CDModalidade',$this->CDModalidade);

		$criteria->compare('NMModalidade',$this->NMModalidade,true);
		
		$criteria->order = 'NMModalidade';

		return new CActiveDataProvider('Modalidade', array(
			'criteria'=>$criteria,
		));
	}
}