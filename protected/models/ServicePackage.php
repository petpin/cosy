<?php

/**
 * This is the model class for table "service_package".
 *
 * The followings are the available columns in table 'service_package':
 * @property integer $id_service
 * @property integer $id_package
 * @property string $creation_date
 */
class ServicePackage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServicePackage the static model class
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
		return 'service_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_service, id_package', 'required'),
			array('id_service, id_package', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_service, id_package, creation_date', 'safe', 'on'=>'search'),
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
			'package'=>array(self::BELONGS_TO, 'Package', 'id_package'),
            'service'=>array(self::BELONGS_TO, 'Service', 'id_service'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_service' => Yii::t('contentForm','Id Service'),
			'id_package' => Yii::t('contentForm','Id Package'),
			'creation_date' => Yii::t('contentForm','Creation Date'),
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

		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('id_package',$this->id_package);
		$criteria->compare('creation_date',$this->creation_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}