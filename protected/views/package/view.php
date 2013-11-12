<?php
$this->breadcrumbs=array(
	Yii::t('contentForm','Packages')=>array('admin'),
	$model->name,
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/package.js'
);
?>

<?php /* Click in last selected tab */ ?>
<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function(){ 
			$('#<?php if(!isset(Yii::app()->session['packageViewTab'])) echo "linkPackageTab1"; else echo Yii::app()->session['packageViewTab']; ?>').click();
		}, 100 );
	});
</script>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('contentForm','MANAGE'),
    'type'=>'info',
    'url'=>Yii::app()->createUrl("package/admin"),
)); ?>

<center><h2><?php $this->widget('editable.EditableField', array(
	'type'      => 'text',
	'model'     => $model,
	'attribute' => 'name',
	'url'       => $this->createUrl('package/updateEditable'), 
	'placement' => 'top',
)); ?></h2></center>

<div style="clear: both; height: 10px;"></div>

<div class="tabbable">
  <ul class="nav nav-tabs">
    <li><a href="#tab1" data-toggle="tab" id="linkPackageTab1"><?php echo Yii::t('contentForm','Details'); ?></a></li>
    <li><a href="#tab2" data-toggle="tab" id="linkPackageTab2"><?php echo Yii::t('contentForm','Services'); ?></a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane<?php if(Yii::app()->session['packageViewTab'] == 'tab1') echo ' active'; ?>" id="tab1">

  		<div>
	      	<?php $this->widget('bootstrap.widgets.TbDetailView',array(
				'type'=>'striped bordered condensed',
				'data'=>$model,
				'attributes'=>array(
					'creation_date',
				),
			)); ?>
		</div>
		
		<div style="padding-top: 20px; float: left;"><b>Description:</b></div> <div style="float: left; padding-left: 20px;"><?php $this->widget('editable.EditableField', array(
			'type'      => 'textarea',
			'model'     => $model,
			'attribute' => 'description',
			'url'       => $this->createUrl('pakage/updateEditable'), 
			'placement' => 'right',
		)); ?>
		</div>

    </div>
    <div class="tab-pane<?php if(Yii::app()->session['packageViewTab'] == 'tab2') echo ' active'; ?>" id="tab2">
    
    	<script type="text/javascript">
    	$(document).ready(function() {
		    $("#linkPackageTab2").click(function() {
				viewCreateServicePackage('<?php echo $model->id; ?>', 'viewGuestContent');
			});
		});
		</script>
    	<div id="viewGuestContent"></div>
    	
    </div>
  </div>
</div>