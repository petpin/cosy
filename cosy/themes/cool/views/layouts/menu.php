<?php
	$r = current(explode("/", $_GET["r"]));
	$link = $_GET["r"];
?>

<div id="mainMenu">
	<ul class="floatLeft">
		<?php if(isset($this->breadcrumbs)): ?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			));
			?>
		<?php endif ?>
	</ul>
	<ul class="floatRight">
	
		<?php 
		if(!Yii::app()->user->isGuest)
		{
		?>
	
		<li><a href="index.php?r=site/index" title="Introduction" <?php if( !isset($_GET["r"]) OR (strcmp ( $r , 'site')==0 && strcmp ( $link , 'site/management') != 0 && strcmp ( $link , 'site/login') != 0 )) echo 'class="here"'; ?>>Intro</a></li>
		
		<li><a href="index.php?r=booking/index" title="Booking" <?php if( strcmp ( $r , 'booking' )==0) echo 'class="here"'; ?>>Booking</a></li>
		
		<li><a href="index.php?r=site/management" title="Management" <?php if( strcmp ( $link , 'site/management' ) == 0 OR strcmp ( $r , 'employee')==0 OR strcmp ( $r , 'room')==0 OR strcmp ( $r , 'guest')==0 ) echo 'class="here"'; ?>>Management</a></li>
		
		<li><a href="index.php?r=site/logout" title="Management">Logout (<?php echo Yii::app()->user->name; ?>)</a></li>
		
		<?php
		}
		else
		{
			?>
			<li><a href="index.php?r=site/login" title="Management" <?php if( strcmp ( $link , 'site/login' )==0) echo 'class="here"'; ?>>Login</a></li>
			<?php
		}
		?>
	</ul>
</div>