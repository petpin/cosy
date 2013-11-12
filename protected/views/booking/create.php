<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKINGS')=>array('admin'),
	Yii::t('contentForm','CREATE'),
);
?>

<fieldset>
 
    <legend><?php echo Yii::t('contentForm','CREATE_BOOKING'); ?></legend>

	<?php 
	if(isset($error)) echo '<span class="label label-important">' . $error . '</span>';
	
	echo $this->renderPartial('_form', array('model'=>$model)); 
	?>

</fieldset>