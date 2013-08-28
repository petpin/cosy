<?php
$this->breadcrumbs=array(
    'Booking Days'=>array('admin'),
    'Create',
);
?>

<h1>Create Booking Day</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>