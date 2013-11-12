<?php

/**
 * BookingForm class.
 * BookingForm is the data structure for keeping
 * booking form data. It is used by the 'booking' action of 'SiteController'.
 */
class BookingForm extends CFormModel
{
	public $client_name;
	public $client_email;
	public $night_num;
	public $bed_num;
	public $start_date;
	public $cost;
	public $paid;
	public $id_room;
	public $id_state;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
		array('client_name, client_email, night_num, bed_num, start_date, cost, paid, id_state', 'required'),
		array('night_num, bed_num, paid, id_room', 'numerical', 'integerOnly'=>true),
		array('cost', 'numerical'),
		array('client_email', 'email'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'client_name'=>Yii::t('contentForm','CLIENT_NAME'),
			'client_email'=>Yii::t('contentForm','CLIENT_EMAIL'),
			'night_num'=>Yii::t('contentForm','NIGHT_NUM'),
			'bed_num'=>Yii::t('contentForm','BED_NUM'),
			'start_date'=>Yii::t('contentForm','START_DATE'),
			'cost'=>Yii::t('contentForm','COST'),
			'paid'=>Yii::t('contentForm','PAID'),
			'id_room'=>Yii::t('contentForm','ID_ROOM'),
			'id_state'=>Yii::t('contentForm','ID_STATE'),
		);
	}
}