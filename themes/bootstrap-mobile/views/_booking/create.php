<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','BOOKINGS')=>array('index'),
	Yii::t('contentForm','CREATE'),
);
?>

<fieldset>
 
    <legend><?php echo Yii::t('contentForm','CREATE_BOOKING'); ?></legend>

	<?php 
	if(isset($error)) echo '<span class="required">' . $error . '</span>'; 
	
	echo $this->renderPartial('_form', array('model'=>$model)); 
	?>

</fieldset>