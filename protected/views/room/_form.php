<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'roomForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <div>
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div>
        <?php echo $form->labelEx($model,'bed_num'); ?>
        <?php echo $form->textField($model,'bed_num'); ?>
        <?php echo $form->error($model,'bed_num'); ?>
    </div>

    <div>
        <?php
        echo $form->labelEx($model,'id_type');
        echo $form->dropDownList($model, 'id_type', CHtml::listData(RoomType::model()->findAll(), 'id', 'description'));
        echo $form->error($model,'id_type');
        ?>
    </div>
    
    <p class="note"><?php echo Yii::t('contentForm','FIELDS_WITH'); ?> <span class="required">* </span><?php echo Yii::t('contentForm','ARE_REQUIRED'); ?>.</p>
 
    <div class="form-actions">
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? Yii::t('contentForm','CREATE') : Yii::t('contentForm','SAVE'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->