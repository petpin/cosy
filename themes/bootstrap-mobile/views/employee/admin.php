<?php
$this->breadcrumbs=array(
    'Employees'=>array('admin'),
    'Manage',
);
?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create',
    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // null, 'large', 'small' or 'mini'
    'url'=>Yii::app()->createUrl("employee/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'employee-type-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name', 'surname', 'phone', 'email', 
        array(
            'name' => 'employeeTypeName',
            'value' => '$data->employeeType->description',
        ),
        array(
        	'header'=>'Options',
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'view'=>
                    array(
                        'url'=>'Yii::app()->createUrl("employee/view", array("id"=>$data->id))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }'
                            ),
                        ),
                    ),
                /*'update'=>
                    array(
                        'url'=>'Yii::app()->createUrl("employee/update", array("id"=>$data->id, "isDialog"=>true))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#updateModal .modal-body p").html(data); $("#updateModal").modal(); }'
                            ),
                        ),
                    ),*/
            ),
        ),
    ),
)); ?>

<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal')); ?>
<!-- Popup Header -->
<div class="modal-header">
	<h4>View Employee Details</h4>
</div>
<!-- Popup Content -->
<div class="modal-body">
	<p>Employee Details</p>
</div>
<!-- Popup Footer -->
<div class="modal-footer">
	<!-- close button -->
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Close',
	    'url'=>'#',
	    'htmlOptions'=>array('data-dismiss'=>'modal'),
	)); ?>
	<!-- close button ends-->
</div>
<?php $this->endWidget(); ?>
<!-- View Popup ends -->

<!-- Update Popup  -->
<?php /*$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'updateModal')); ?>
<!-- Popup Header -->
<div class="modal-header">
	<h4>Update Employee Details</h4>
</div>
<!-- Popup Content -->
<div class="modal-body">
	<p>Employee Details</p>
</div>
<!-- Popup Footer -->
<div class="modal-footer">
	<!-- close button -->
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Close',
	    'url'=>'#',
	    'htmlOptions'=>array('data-dismiss'=>'modal'),
	)); ?>
	<!-- close button ends-->
</div>
<?php $this->endWidget();*/ ?>
<!-- Update Popup ends -->