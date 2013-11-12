<?php
class BookingDetails extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'booking_details';
	}

	public function rules()
	{
		return array(
			array('id, comments', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('comments', 'safe'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('contentForm','ID'),
			'comments' => Yii::t('contentForm','COMMENTS'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}