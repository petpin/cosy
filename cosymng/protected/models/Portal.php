<?php

/**
 * This is the model class for table "portal".
 *
 * The followings are the available columns in table 'portal':
 * @property string $id
 * @property string $name
 * @property string $connection_string
 * @property string $user_bd
 * @property string $password_bd
 * @property string $id_state
 * @property string $validity
 * @property string $id_package
 */
class Portal extends CActiveRecord
{
	public $stateName;
	public $packageName;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Portal the static model class
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
		return 'portal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, connection_string, user_bd, password_bd, id_state, validity, id_package', 'required'),
			array('name, password_bd', 'length', 'max'=>50),
			array('connection_string', 'length', 'max'=>150),
			array('user_bd', 'length', 'max'=>20),
			array('id_state', 'length', 'max'=>2),
			array('validity', 'length', 'max'=>100),
			array('id_package', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, connection_string, user_bd, password_bd, id_state, validity, id_package, stateName, packageName', 'safe', 'on'=>'search'),
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
			'package' => array(self::BELONGS_TO, 'Package', 'id_package'),
			'state' => array(self::BELONGS_TO, 'State', 'id_state'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'connection_string' => 'Connection String',
			'user_bd' => 'User Bd',
			'password_bd' => 'Password Bd',
			'id_state' => 'Id State',
			'validity' => 'Validity',
			'id_package' => 'Id Package',
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
		
		$criteria->with = array( 'state' );
		$criteria->with = array( 'package' );

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('connection_string',$this->connection_string,true);
		$criteria->compare('user_bd',$this->user_bd,true);
		$criteria->compare('password_bd',$this->password_bd,true);
		$criteria->compare('id_state',$this->id_state,true);
		$criteria->compare('validity',$this->validity,true);
		$criteria->compare('id_package',$this->id_package,true);
		$criteria->compare('state.name', $this->stateName, true );
		$criteria->compare('package.name', $this->packageName, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
			'sort'=>array(
				'attributes'=>array(
					'stateName'=>array(
						'asc'=>'state.name',
						'desc'=>'state.name DESC',
					),
					'packageName'=>array(
						'asc'=>'package.name',
						'desc'=>'package.name DESC',
					),
					'*',
				),
			),
		));
	}
}