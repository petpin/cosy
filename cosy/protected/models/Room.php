<?php

/**
 * This is the model class for table "room".
 *
 * The followings are the available columns in table 'room':
 * @property integer $id
 * @property string $title
 * @property integer $bed_num
 * @property integer $id_type
 */
class Room extends CActiveRecord
{
	public $roomTypeDescription;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Room the static model class
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
        return 'room';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
			array('title, bed_num, id_type', 'required'),
			array('bed_num, id_type', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, bed_num, id_type, roomTypeDescription', 'safe', 'on'=>'search'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
            return array(
                'bookingRoom'=>array(self::HAS_MANY, 'BookingRoom', 'id_room'),
                'roomType'=>array(self::BELONGS_TO, 'RoomType', 'id_type'),
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'bed_num' => 'Bed Num',
			'id_type' => 'Id Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with=array('roomType');

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('bed_num',$this->bed_num);
		$criteria->compare('id_type',$this->id_type);
		
		$criteria->compare('roomType.description', $this->roomTypeDescription, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'roomTypeDescription'=>array(
						'asc'=>'roomType.description',
						'desc'=>'roomType.description DESC',
					),
					'*',
				),
			),
		));
	}
	
	/**
	 * Verify room space for a specific day
	 * @param room_id -> Room Id
	 * @param day -> Day to verify
	 */
	public function verifyDaySpace($room_id, $day)
	{
		$totalReservedBeds = 0;
		$free_beds = 0;
		
		$room = Room::model()->findByPk($room_id);
		
		$criteria = new CDbCriteria;
		$criteria->condition='day=:day AND id_room=:id_room';
		$criteria->params=array(':day'=>$day, ':id_room'=>$room_id);
		$bookingDays = BookingDays::model()->findAll($criteria);
		
		foreach($bookingDays as $bookingDay)
		{
			$totalReservedBeds += $bookingDay->bed_num;
		}
		
		$free_beds = $room->bed_num - $totalReservedBeds;
		
		return $free_beds;
	}
}