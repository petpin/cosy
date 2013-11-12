<?php

/**
 * This is the model class for table "supplier".
 *
 * The followings are the available columns in table 'supplier':
 * @property string $id
 * @property string $name
 * @property string $url
 * @property integer $rate_value
 */
class Supplier extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Supplier the static model class
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
		return 'supplier';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url, rate_value', 'required'),
			array('rate_value', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>20),
			array('url', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, rate_value', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('contentForm','SUPPLIER_NAME'),
			'url' => Yii::t('contentForm','URL'),
			'rate_value' => Yii::t('contentForm','RATE_VALUE_%'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('rate_value',$this->rate_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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