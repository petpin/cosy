<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property string $booking_date
 * @property integer $night_num
 * @property string $start_date
 * @property float $value
 * @property integer $paid
 * @property integer $id_employee
 * @property integer $id_state
 * @property integer $id_payment
 */
class Booking extends CActiveRecord
{
    public $client_name;
    public $client_email;
    public $cost;
    public $id_room;
    public $bed_num;
    public $roomTitle;
    public $stateDescription;
    public $id_supplier;
    public $supplierName;
    public $bed_price;
    public $bedNumberCount;
    public $comments;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'booking';
    }

    public function rules()
    {
        return array(
            array('booking_date, night_num, start_date, value, id_employee, id_state, id_payment, id_supplier, client_name, client_email, bed_num, id_room', 'required'),
            array('night_num, paid, id_employee, id_state, id_payment', 'numerical', 'integerOnly'=>true),
            array('value', 'numerical'),
            array('client_email', 'email'),
            array('booking_date, night_num, start_date, value, paid, id_employee, id_state, id_payment', 'safe', 'on'=>'update'),
            array('id, booking_date, night_num, start_date, value, paid, id_employee, id_state, id_payment, client_name, roomTitle, stateDescription, supplierName, bedNumberCount', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            //'bookingGuest'=>array(self::HAS_MANY, 'BookingGuest', 'id_booking'),
            'bookingDays'=>array(self::HAS_MANY, 'BookingDays', 'id_booking'),
            'bookingState'=>array(self::BELONGS_TO, 'BookingState', 'id_state'),
            'room'=>array(
                self::HAS_ONE,'Room',array('id_room'=>'id'),
                    'through'=>'bookingDays'
            ),
            'supplier'=>array(
                self::HAS_ONE,'Supplier',array('id_supplier'=>'id'),
                    'through'=>'bookingDays'
            ),
           	'bookingGuest'=>array(self::HAS_MANY,'BookingGuest','id_booking'),
            'guest'=>array(
                self::HAS_ONE,'Guest',array('id_guest'=>'id'),
                    'through'=>'bookingGuest'
            ),
            'guests'=>array(
                self::HAS_MANY,'Guest',array('id_guest'=>'id'),
                    'through'=>'bookingGuest'
            ),
            'bookingDetails'=>array(
                self::HAS_ONE,'BookingDetails',array('id'=>'id'),
            ),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('contentForm','ID'),
            'booking_date' => Yii::t('contentForm','BOOKING_DATE'),
            'night_num' => Yii::t('contentForm','NIGHT_NUMBER'),
            'start_date' => Yii::t('contentForm','START_DATE'),
            'value' => Yii::t('contentForm','PRICE_PER_DAY'),
            'paid' => Yii::t('contentForm','PAID'),
            'id_employee' => Yii::t('contentForm','ID_EMPLOYEE'),
            'id_state' => Yii::t('contentForm','ID_STATE'),
            'id_payment' => Yii::t('contentForm','ID_PAYMENT'),
            'id_room' => Yii::t('contentForm','ROOM'),
            'id_supplier' => Yii::t('contentForm','SUPPLIER'),
            'supplierName' => Yii::t('contentForm','SUPPLIER_NAME'),
            'client_name' => Yii::t('contentForm','CLIENT_NAME'),
            'bedNumberCount' => Yii::t('contentForm','BED_NUMBER'),
            'stateDescription' => Yii::t('contentForm','STATE_DESCRIPTION'),
            'client_email' => Yii::t('contentForm','CLIENT_EMAIL'),
            'bed_num' => Yii::t('contentForm','BED_NUM'),
            'Payment' => Yii::t('contentForm','PAYMENT'),
            'Guest' => Yii::t('contentForm','GUEST'),
            'State' => Yii::t('contentForm','STATE'),
            'comments' => Yii::t('contentForm','Comments'),
            //'Booking State' => Yii::t ('contentForm','BOOKING_STATE')
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        //$criteria->with = array( 'bookingGuest', 'guest' );
		
		$bookingDaysTableName = BookingDays::model()->tableName();
		$bedNumberCountSql = "(select sum(bed_num) from $bookingDaysTableName where $bookingDaysTableName.id_booking = t.id)";
		
		$criteria->select = array(
			'*',
			$bedNumberCountSql . " as bedNumberCount",
		);
		
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.booking_date',$this->booking_date,false);
        $criteria->compare('t.night_num',$this->night_num);
        $criteria->compare('t.start_date',$this->start_date,true);
        $criteria->compare('t.value',$this->value);
        $criteria->compare('t.paid',$this->paid);
        $criteria->compare('t.id_employee',$this->id_employee);
        $criteria->compare('t.id_state',$this->id_state);
        $criteria->compare('t.id_payment',$this->id_payment);
        
        $criteria->order = 't.start_date desc';
        
        $criteria->compare($bedNumberCountSql, $this->bedNumberCount);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
					'bedNumberCount' => array(
						'asc' => 'bedNumberCount ASC',
						'desc' => 'bedNumberCount DESC',
					),
                    '*',
                ),
            ),
            /*'pagination'=>array(
                'pageSize'=>15,
            ),*/
        ));
    }
    
    /*
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->with = array( 'bookingGuest', 'bookingState', 'guest', 'supplier' );

		// sub query to retrieve the count of beds
		$bookingDaysTableName = BookingDays::model()->tableName();
		$bedNumberCountSql = "(select sum(bed_num) from $bookingDaysTableName where $bookingDaysTableName.id_booking = t.id)";
		
		$criteria->select = array(
			'*',
			$bedNumberCountSql . " as bedNumberCount",
		);
		
        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.booking_date',$this->booking_date,true);
        $criteria->compare('t.night_num',$this->night_num);
        $criteria->compare('t.start_date',$this->start_date,true);
        $criteria->compare('t.value',$this->value);
        $criteria->compare('t.paid',$this->paid);
        $criteria->compare('t.id_employee',$this->id_employee);
        $criteria->compare('t.id_state',$this->id_state);
        $criteria->compare('t.id_payment',$this->id_payment);

        $criteria->compare('guest.name', $this->client_name, true );
        $criteria->compare('supplier.name', $this->supplierName, true );
        //$criteria->compare('room.title', $this->roomTitle, true );
        $criteria->compare('bookingState.description', $this->stateDescription, true );
		
		$criteria->compare($bedNumberCountSql, $this->bedNumberCount);
		
		//$criteria->'order'=>'start_date DESC',

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'client_name'=>array(
                        'asc'=>'guest.name',
                        'desc'=>'guest.name DESC',
                    ),
                    'supplierName'=>array(
                        'asc'=>'supplier.name',
                        'desc'=>'supplier.name DESC',
                    ),
                    'roomTitle'=>array(
                        'asc'=>'bookingRoom.title',
                        'desc'=>'bookingRoom.title DESC',
                    ),
                    'stateDescription'=>array(
                        'asc'=>'bookingState.description',
                        'desc'=>'bookingState.description DESC',
                    ),
					'bedNumberCount' => array(
						'asc' => 'bedNumberCount ASC',
						'desc' => 'bedNumberCount DESC',
					),
                    '*',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
    }
    */

    /*

    */
    public function convertDotToComma($value)
    {
        $value = str_replace('.', ',', $value);

        return $value;
    }

    /*

    */
    public function convertCommaToDot($value)
    {
        $value = str_replace(',', '.', $value);

        return $value;
    }
    
    public function behaviors() {
       return array(
           'ERememberFiltersBehavior' => array(
               'class' => 'application.components.ERememberFiltersBehavior',
               'defaults'=>array(),           /* optional line */
               'defaultStickOnClear'=>false   /* optional line */
           ),
       );
	}
	
	/**
	 * Count the number of rows which match the user ID
	 * @param int $uid The user ID
	 * @return int The number of found rows
	 */
	public function getTotalValueByBookingId($bookingId, $pricePerNight)
	{
	    $count = $this->count(array(
	        'condition'=>'id = :bookingId',
	        'params'=>array(
	            ':bookingId'=>$bookingId,
	        ),
	    ));
	    
	    $totalBookingDays = BookingDays::model()->countByAttributes(array(
            'id_booking'=> $bookingId
        ));
        
        $totalGuests = BookingGuest::model()->countByAttributes(array(
            'id_booking'=> $bookingId
        ));
	    
	    return $totalGuests*$totalBookingDays*$pricePerNight;
	}
}