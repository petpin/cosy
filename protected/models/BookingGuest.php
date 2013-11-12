<?php

/**
 * This is the model class for table "booking_guest".
 *
 * The followings are the available columns in table 'booking_guest':
 * @property integer $id_booking
 * @property integer $id_guest
 */
class BookingGuest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BookingGuest the static model class
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
		return 'booking_guest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            return array(
		array('id_booking, id_guest', 'required'),
		array('id_booking, id_guest', 'numerical', 'integerOnly'=>true),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id_booking, id_guest', 'safe', 'on'=>'search'),
            );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
            'booking'=>array(self::BELONGS_TO, 'Booking', 'id_booking'),
            'guest'=>array(self::BELONGS_TO, 'Guest', 'id_guest'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_booking' => Yii::t('contentForm','ID_BOOKING'),
			'id_guest' => Yii::t('contentForm','ID_GUEST'),
			'guest' => Yii::t('contentForm','GUEST')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id_booking',$this->id_booking);
		$criteria->compare('id_guest',$this->id_guest);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}