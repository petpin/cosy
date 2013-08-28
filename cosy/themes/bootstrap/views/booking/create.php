<?php
$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Create',
);
?>

<fieldset>
 
    <legend>Create Booking</legend>

	<?php 
	if(isset($error)) echo '<span class="required">' . $error . '</span>'; 
	
	echo $this->renderPartial('_form', array('model'=>$model)); 
	?>

</fieldset>