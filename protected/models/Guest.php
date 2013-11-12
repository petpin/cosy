<?php

/**
 * This is the model class for table "guest".
 *
 * The followings are the available columns in table 'guest':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $id_language
 * @property integer $id_country
 * @property integer $document_id
 * @property string $details
 * @property string $residence
 * @property string $birth_date
 */
class Guest extends CActiveRecord
{
	public $languageDescription;
    public $countryName;
    // Variável usada na associação de novos clientes a uma reserva existente
    public $idBooking;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Guest the static model class
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
		return 'guest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
		array('name, email', 'required'),
		array('id_language, id_country, phone', 'numerical', 'integerOnly'=>true),
		array('name, email', 'length', 'max'=>50),
		array('details', 'length', 'max'=>200),
		array('document_id, residence', 'length', 'max'=>20),
		array('id, name, email, phone, id_language, details, document_id, id_country, residence, birth_date, languageDescription, countryName', 'safe', 'on'=>'search'),
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
			'bookingGuest'=>array(self::HAS_MANY, 'BookingGuest', 'id_guest'),
			'language'=>array(self::BELONGS_TO, 'Language', 'id_language'),
                        'country'=>array(self::BELONGS_TO, 'Country', 'id_country'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => Yii::t('contentForm','ID'),
                    'name' => Yii::t('contentForm','NAME'),
                    'email' => Yii::t('contentForm','EMAIL'),
                    'phone' => Yii::t('contentForm','PHONE'),
                    'id_language' => Yii::t('contentForm','LANGUAGE'),
                    'details' => Yii::t('contentForm','DETAILS'),
                    'residence' => Yii::t('contentForm','RESIDENCE'),
                    'birth_date' => Yii::t('contentForm','BIRTH_DATE'),
                    'countryName' => Yii::t('contentForm','COUNTRY_NAME'),
                    'languageDescription' => Yii::t('contentForm','LANGUAGE'),
                    'document_id' => Yii::t('contentForm','DOCUMENT_ID'),
                    'id_country' => Yii::t('contentForm','ID_COUNTRY')
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
		
		$criteria->with = array( 'language', 'country' );

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.phone',$this->phone,true);
		$criteria->compare('t.id_language',$this->id_language);
		$criteria->compare('t.details',$this->details,true);
		$criteria->compare('language.description', $this->languageDescription, true );
                $criteria->compare('country.name', $this->countryName, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'countryName'=>array(
						'asc'=>'country.description',
						'desc'=>'country.description DESC',
					),
                                        'languageDescription'=>array(
						'asc'=>'language.description',
						'desc'=>'language.description DESC',
					),
					'*',
				),
			),
		));
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
}