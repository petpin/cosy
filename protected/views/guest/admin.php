<?php $this->breadcrumbs=array(
    Yii::t('contentForm','GUESTS')=>array('admin'),
    Yii::t('contentForm','MANAGE'),
); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=> Yii::t('contentForm','CREATE'),
    'type'=>'success',
    'url'=>Yii::app()->createUrl("guest/create"),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'id'=>'guest-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'pagerCssClass'=>'pagination pagination-centered',
    'columns'=>array(
    	array(
           'class' => 'editable.EditableColumn',
           'name' => 'name',
           'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				'url'        => $this->createUrl('guest/updateEditable'),
				'placement'  => 'right',
			)               
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'email',
           'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				'url'        => $this->createUrl('guest/updateEditable'),
				'placement'  => 'right',
			)               
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'phone',
           'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				'url'        => $this->createUrl('guest/updateEditable'),
				'placement'  => 'right',
			)               
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'languageDescription',
           'value' => '$data->language->description',
           'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				'source'    => Editable::source(Language::model()->findAll(), 'id', 'description'),
				'url'        => $this->createUrl('guest/updateEditable'),
				'placement'  => 'right',
			)               
        ),
        array(
           'class' => 'editable.EditableColumn',
           'name' => 'countryName',
           'value' => '$data->country->name',
           'editable' => array(    //editable section
				//'apply'      => '$data->user_status != 4', //can't edit deleted users
				//'source'    => Editable::source(Country::model()->findAll(), 'id', 'name'),
				'url'        => $this->createUrl('guest/updateEditable'),
				'placement'  => 'right',
			)               
        ),
        array(
            'header'=>Yii::t('contentForm','OPTIONS'),
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                /*'view'=>
                    array(
                        'url'=>'Yii::app()->createUrl("guest/view", array("id"=>$data->id))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#viewModal .modal-body p").html(data); $("#viewModal").modal(); }'
                            ),
                        ),
                    ),*/
                /*'update'=>
                    array(
                        'url'=>'Yii::app()->createUrl("guest/update", array("id"=>$data->id, "isDialog"=>true))',
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
));
?>

<!-- View Popup  -->
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'viewModal', /*'class'=>'width: 90%;'*/)); ?>
<!-- Popup Header -->
<div class="modal-header">
	<h4><?php echo Yii::t('contentForm','VIEW_EMPLOYEE_DETAILS'); ?></h4>
</div>
<!-- Popup Content -->
<div class="modal-body">
	<p><?php echo Yii::t('contentForm','EMPLOYEE_DETAILS'); ?></p>
</div>
<!-- Popup Footer -->
<div class="modal-footer">
	<!-- close button -->
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>Yii::t('contentForm','CLOSE'),
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