<?php

/**
 * This is the model class for table "PA_Plano_Avaliacao".
 *
 * The followings are the available columns in table 'PA_Plano_Avaliacao':
 * @property integer $id
 * @property integer $id_plano
 * @property integer $id_avaliacao
 * @property integer $bimestre
 */
class PAPlanoAvaliacao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PAPlanoAvaliacao the static model class
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
		return 'PA_Plano_Avaliacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_plano, id_avaliacao, bimestre', 'required'),
			array('id_plano, id_avaliacao, bimestre', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_plano, id_avaliacao, bimestre', 'safe', 'on'=>'search'),
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
			'relPlano' => array(self::BELONGS_TO, 'PAPlanoEtapa', 'id_plano'),
			'relAvaliacao' => array(self::BELONGS_TO, 'PAAvaliacao', 'id_avaliacao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_plano' => 'Id Plano',
			'id_avaliacao' => 'Id Avaliacao',
			'bimestre' => 'Bimestre',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_plano',$this->id_plano);
		$criteria->compare('id_avaliacao',$this->id_avaliacao);
		$criteria->compare('bimestre',$this->bimestre);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}