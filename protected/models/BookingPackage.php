<?php

/**
 * This is the model class for table "booking_package".
 *
 * The followings are the available columns in table 'booking_package':
 * @property integer $id_booking
 * @property integer $id_package
 * @property string $create_date
 * @property string $last_update_date
 */
class BookingPackage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BookingPackage the static model class
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
		return 'booking_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_booking, id_package', 'required'),
			array('id_booking, id_package', 'numerical', 'integerOnly'=>true),
			array('last_update_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_booking, id_package, create_date, last_update_date', 'safe', 'on'=>'search'),
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
			'booking'=>array(self::BELONGS_TO, 'Booking', 'id_booking'),
            'package'=>array(self::BELONGS_TO, 'Package', 'id_package'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_booking' => 'Id Booking',
			'id_package' => 'Id Package',
			'create_date' => 'Create Date',
			'last_update_date' => 'Last Update Date',
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

		$criteria->compare('id_booking',$this->id_booking);
		$criteria->compare('id_package',$this->id_package);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('last_update_date',$this->last_update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}