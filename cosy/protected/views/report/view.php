<?php $this->pageTitle=Yii::app()->name; ?>

<p>REPORTING</p>

<div style="padding-left: 20px; padding-right: 20px;">
	
	
	<p>YEAR - De <b>2012-01-01</b> a <b>2012-12-31</b></p>
	<?php
	if(!Yii::app()->user->isGuest)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='day>:day_start AND day<:day_end';
		$criteria->params=array(':day_start'=>'2011-01-01', ':day_end'=>'2012-12-31');

		$this->getStats($criteria);
	}
	?>
	<p>MONTH - De <b>2012-02-01</b> a <b>2012-02-28</b></p>
	<?php
	if(!Yii::app()->user->isGuest)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='day>=:day_start AND day<:day_end';
		$criteria->params=array(':day_start'=>'2012-02-01', ':day_end'=>'2012-03-01');

		$this->getStats($criteria);
	}
	?>
	<p>WEEK - De <b>2012-02-06</b> a <b>2012-2-12</b></p>
	<?php
	if(!Yii::app()->user->isGuest)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='day>:day_start AND day<:day_end';
		$criteria->params=array(':day_start'=>'2012-02-06', ':day_end'=>'2012-2-12');
		
		$this->getStats($criteria);
	}
	?>
	
</div>
