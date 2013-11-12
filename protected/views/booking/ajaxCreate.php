<?php
if(isset($error)) echo '<span class="required">' . $error . '</span>';

echo $this->renderPartial('_form', array('model'=>$model));
?>