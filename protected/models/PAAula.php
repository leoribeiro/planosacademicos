<?php

/**
 * This is the model class for table "PA_Aula".
 *
 * The followings are the available columns in table 'PA_Aula':
 * @property integer $id
 * @property string $data
 * @property string $conteudo
 * @property string $material
 */
class PAAula extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PAAula the static model class
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
		return 'PA_Aula';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conteudo', 'required'),
			array('material', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,aulas, conteudo, material', 'safe', 'on'=>'search'),
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
			'relPlanoAula' => array(self::BELONGS_TO, 'PAPlanoAula', 'id_aula'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'data' => 'Data',
			'conteudo' => 'Conteudo',
			'material' => 'Material',
			'aulas' => 'Aulas',
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
		$criteria->compare('data',$this->data,true);
		$criteria->compare('conteudo',$this->conteudo,true);
		$criteria->compare('material',$this->material,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

public function behaviors()
{
    return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); // 'ext' is in Yii 1.0.8 version. For early versions, use 'application.extensions' instead.
}
}