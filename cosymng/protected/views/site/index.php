<div id="intro">
	<div class="inner">
		<div class="wrap clearFix">
			
			<h1>Hostels Management.. <strong>CosyApp..</strong></h1>
			
			<p>Welcome to your simple, flexible and low-cost hostel management web-base application.</p>                    
			
			<a href="index.php?r=site/presentation" class="button" title="CosyApp Presentation">View Presentation</a>

		</div>
	</div>
</div> <!-- / #intro -->                  

<hr>  

<div id="content">                
	<div class="wrap clearFix">
	
		<h2>SOME OF THE COOL FEATURES</h2>
		
		<div class="clearFix">
			<div class="col floatLeft">

				<img src="images/icon-location.png" alt="" class="icon">

				<h3>Employees</h3>

				<p>Manage your employees.</p>

			</div>

			<div class="col floatRight">

				<img src="images/icon-location.png" alt="" class="icon">
				
				<h3>Bookings</h3>

				<p>Manage your bookings.</p>

			</div>
		</div>
		
		<div class="clearFix">
			<div class="col floatLeft">

				<img src="images/icon-location.png" alt="" class="icon">

				<h3>Rooms</h3>

				<p>Manage your rooms.</p>

			</div>

			<div class="col floatRight">

				<img src="images/icon-location.png" alt="" class="icon">
				
				<h3>Beds</h3>

				<p>Manage your beds.</p>

			</div>
		</div>
		
		<div class="clearFix">
			<div class="col floatLeft">

				<img src="images/icon-location.png" alt="" class="icon">

				<h3>Guest</h3>

				<p>Get a full of <b>customer features</b> that will make you create a better <u>Customer Relationship</u> with your Clients.</p>

			</div>

			<div class="col floatRight">

				<img src="images/icon-backup.png" alt="" class="icon">
				
				<h3>24/7 Back Up</h3>

				<p>It's included</p>

			</div>
		</div>

		<div class="clearFix">
			<div class="col floatLeft">

				<!--<img src="images/icon-twitter.png" alt="" class="icon">-->
				<img src="images/icon-awards.png" alt="" class="icon">

				<h3>Reporting</h3>

				<p>...</p>

			</div>

			<div class="col floatRight">

				<img src="images/icon-stats.png" alt="" class="icon">
				
				<h3>Full Realtime Statistics</h3>

				<p>...</p>

			</div>
		</div>

		<div class="clearFix">
			<div class="col floatLeft">

				<img src="images/icon-tools.png" alt="" class="icon">

				<h3>Highly Customisable</h3>

				<p>Cosy is adjustable, malleable to your business and also to your site.</p>

			</div>

			<div class="col floatRight">

				<img src="images/icon-backup.png" alt="" class="icon">
				
				<h3>24/7 Support</h3>

				<p>Checked !</p>

			</div>
		</div>

		<div class="buttonCentered">
			<a class="button iconRight">TAKE A FEATURE TOUR - SOON<i class="more"></i></a>
		</div>

		<h2>WHAT OUR CUSTOMERS ARE SAYING</h2>

		<ul class="cols clearFix">
			<li>
				<p>Portuguese software, adjustable to your business and your needs.</p>
				<p><strong>Nelson Ferreira</strong>, Developer</p>
			</li>
			<li class="middle">
				<p>...</p>
				<p><strong>... ...</strong>, ...</p>
			</li>
			<li>
				<p>...</p>
				<p><strong>... ...</strong>, ...</p>
			</li>
		</ul>

		<form action="./" method="post">
			<fieldset>

				<label for="email">To stay in touch, simply subscribe to our newsletter.</label>
				<input type="text" class="text" id="email">
				<button type="submit" class="button iconLeft"><i class="email"></i> SUBSCRIBE</button> 

			</fieldset>
		</form>

	</div>
</div> <!-- / #content -->      
<?php 
	// Vista por defeito
	//echo $this->renderPartial('roomView', array());
	//echo $this->renderPartial('excelView', array());
?>

<?php
/*
function RecursiveCopy($source, $dest, $diffDir = ''){ 
    $sourceHandle = opendir($source); 
    if(!$diffDir) 
            $diffDir = $source; 
    
    //mkdir($dest . '/' . $diffDir); 
    echo $dest . ' - ' . $diffDir . '<br/>'; 
    
    while($res = readdir($sourceHandle))
    { 
        if($res == '.' || $res == '..') 
            continue; 
        
        if(is_dir($source . '/' . $res)){ 
            RecursiveCopy($source . '/' . $res, $dest, $diffDir . '/' . $res); 
        } else { 
            //copy($source . '/' . $res, $dest . '/' . $diffDir . '/' . $res); 
			//echo ' -> ' . $diffDir . ' - ' . $res . '<br/>'; 
        } 
    } 
} 

echo getcwd() . "<br /><br />";

$yii_cosy_dir = getcwd() . '../cosy/';

if(!Yii::app()->user->isGuest)
	RecursiveCopy(getcwd(), 'pages');
*/
?>
