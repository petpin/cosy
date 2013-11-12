<?php

/**
 * This is the model class for table "guest_service".
 *
 * The followings are the available columns in table 'guest_service':
 * @property integer $id
 * @property integer $id_guest
 * @property integer $id_service
 * @property integer $id_package
 * @property integer $quantity
 * @property string $creation_date
 * @property string $last_modify_date
 */
class GuestService extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GuestService the static model class
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
		return 'guest_service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_guest, id_service, quantity, creation_date, last_modify_date', 'required'),
			array('id_guest, id_service, id_package, quantity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_guest, id_service, id_package, quantity, creation_date, last_modify_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('contentForm','ID'),
			'id_guest' => Yii::t('contentForm','Id Guest'),
			'id_service' => Yii::t('contentForm','Id Service'),
			'id_package' => Yii::t('contentForm','Id Package'),
			'quantity' => Yii::t('contentForm','Quantity'),
			'creation_date' => Yii::t('contentForm','Creation Date'),
			'last_modify_date' => Yii::t('contentForm','Last Modify Date'),
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
		$criteria->compare('id_guest',$this->id_guest);
		$criteria->compare('id_service',$this->id_service);
		$criteria->compare('id_package',$this->id_package);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('last_modify_date',$this->last_modify_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}