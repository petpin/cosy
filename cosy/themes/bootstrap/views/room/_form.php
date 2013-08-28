<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'room-form',
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'Name'); ?>
        <?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'Beds Number'); ?>
        <?php echo $form->textField($model,'bed_num'); ?>
        <?php echo $form->error($model,'bed_num'); ?>
    </div>

    <div class="row">
        <?php
            echo $form->labelEx($model,'Room Type');
            echo $form->dropDownList($model, 'id_type', CHtml::listData(RoomType::model()->findAll(), 'id', 'description'));
            echo $form->error($model,'id_type');
        ?>
    </div>

    <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->