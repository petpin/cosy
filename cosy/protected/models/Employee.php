<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property integer $id_employee_type
 * @property integer $phone
 * @property string $email
 */
class Employee extends CActiveRecord
{
    public $employeeTypeName;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'employee';
    }

    public function rules()
    {
        return array(
            array('name, surname, id_employee_type, phone, email', 'required'),
            array('id_employee_type, phone', 'numerical', 'integerOnly'=>true),
            array('name, surname, email', 'length', 'max'=>50),
            array('id, name, surname, id_employee_type, phone, email, employeeTypeName', 'safe', 'on'=>'search'),
        );
    }

    public function relations()
    {
        return array(
            'employeeType'=>array(self::HAS_ONE, 'EmployeeType', 'id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'id_employee_type' => 'Employee Type', // 'Id Employee Type',
            'phone' => 'Phone',
            'email' => 'Email',
            'employeeTypeName' => 'Employee Type',
        );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->with = array( 'employeeType' );

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('id_employee_type',$this->id_employee_type);
        $criteria->compare('phone',$this->phone);
        $criteria->compare('email',$this->email,true);

        $criteria->compare('employeeType.description', $this->employeeTypeName, true );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'attributes'=>array(
                    'employeeTypeName'=>array(
                        'asc'=>'employeeType.description',
                        'desc'=>'employeeType.description DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    public function validatePassword($password)
    {
        //return $this->hashPassword($password)===$this->password;
        return $password===$this->password;
    }

    public function hashPassword($password)
    {
        return md5($password);
    }
}