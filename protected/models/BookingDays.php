<?php

/**
 * This is the model class for table "booking_days".
 *
 * The followings are the available columns in table 'booking_days':
 * @property integer $id_booking
 * @property string $day
 * @property integer $id_supplier
 * @property integer $price
 * @property integer $id_room
 * @property integer $bed_num
 * @property string $supplier_rate
 *
 * The followings are the available model relations:
 * @property Booking $idBooking
 */
class BookingDays extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'booking_days';
    }

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_booking, day, id_supplier, price, id_room, bed_num, supplier_rate', 'required'),
            array('id_booking, id_supplier, id_room, bed_num', 'numerical', 'integerOnly'=>true),
            array('price', 'numerical'),
            array('supplier_rate', 'length', 'max'=>2),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_booking, day, id_supplier, price, id_room, bed_num, supplier_rate', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'Booking' => array(self::BELONGS_TO, 'Booking', 'id_booking'),
            'Supplier' => array(self::BELONGS_TO, 'Supplier', 'id_supplier'),
            'Room' => array(self::BELONGS_TO, 'Room', 'id_room'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id_booking' => Yii::t('contentForm','ID_BOOKING'),
            'day' => Yii::t('contentForm','Day'),
            'id_supplier' => Yii::t('contentForm','ID_SUPPLIER'),
            'price' => Yii::t('contentForm','Total price per day'),
            'id_room' => Yii::t('contentForm','ID_ROOM'),
            'bed_num' => Yii::t('contentForm','BED_NUM'),
            'supplier_rate' => Yii::t('contentForm','SUPPLIER_RATE'),
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id_booking',$this->id_booking);
        $criteria->compare('day',$this->day,true);
        $criteria->compare('id_supplier',$this->id_supplier);
        $criteria->compare('price',$this->price);
        $criteria->compare('id_room',$this->id_room);
        $criteria->compare('bed_num',$this->bed_num);
        $criteria->compare('supplier_rate',$this->supplier_rate,true);

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
        ));
    }
}